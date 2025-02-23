<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\Temperament;
use DateTime;
use Illuminate\Database\QueryException;

class PonyController extends Controller
{
    /**
     * Prépare les éléments pour afficher la liste des poneys.
     * Les résultats sont paginés: 5 éléments par page
     * @return void
     */
    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $parPage = 5;
        $titre = 'Listing des poneys';
        $ponies = Pony::with('Temperament', 'HourPlanned', 'Hourdone')
            ->paginate($parPage, ['*'], 'page', $page)
            ->withPath('/ponies');
        render('pony.index', compact('ponies', 'titre'));
    }

    /**
     * Prépare les éléments nécessaires à l'affichage des détails d'un poney basé sur son ID
     * @param $PonyId integer   Paramètre qui permet de sélectionner un poney basé sur son ID
     * @return void
     */
    function details($PonyId)
    {
        $titre = "Carte d'identité d'un poney";
        $pony = Pony::with('Temperament')
            ->where('PonyId', $PonyId)
            ->first();
        render('pony.details', compact('pony', 'titre', 'PonyId'));
    }

    /***
     * Préparation des éléments nécessaires à la création d'un formulaire de modification d'un poney
     * @return void
     */
    function edit()
    {
        $PonyId = $_POST['PonyId'];
        $titre = 'Modifier un poney';
        $pony = Pony::with('Temperament')
            ->where('PonyId', $PonyId)
            ->first();
        $temperaments = Temperament::all();
        render('pony.edit', compact('pony', 'temperaments', 'titre', 'PonyId'));
    }

    /***
     * Update un poney sur base des éléments d'un formulaire POST
     * @return void
     */
    function update()
    {
        // Récupère l'ID
        $PonyId = $_POST['PonyId'];

        // Teste la validité des informations
        $validate = request()->validate([
            'DateOfBirth' => 'Date',
            'MaxWorkHour' => 'number',
            'Height' => 'number'
        ]);

        // Si échec, on redirige vers le formulaire de modification
        if (!$validate) {
            $errors = request()->errors();
            $titre = 'Modifier un poney';
            $pony = Pony::with('Temperament')
                ->where('PonyId', $PonyId)
                ->first();
            $temperaments = Temperament::all();
            render('pony.edit', compact('pony', 'temperaments', 'titre', 'PonyId', 'errors'));
        } else {
            $data = request()->postData();
            $pony = Pony::find($data['PonyId']);
            $pony->Name = $data['Name'];
            $pony->DateOfBirth = $data['DateOfBirth'];
            $pony->Height = $data['Height'];
            $pony->TemperamentId = $data['TemperamentId'];
            $pony->MaxWorkHour = $data['MaxWorkHour'];
            $pony->save();
            response()->redirect(route('ponies.details', $data['PonyId']));
        }
    }

    /***
     * Préparation des éléments nécessaires à la création d'un formulaire de création d'un poney
     * @return void
     */
    function create()
    {
        $pony = new Pony();
        $titre = 'Créer un nouveau poney';
        $temperaments = Temperament::all();
        render('pony.create', compact('pony', 'titre', 'temperaments'));

    }

    /**
     * Enregistre le nouveau poney dans la base de données
     * @return void|null
     */
    function store()
    {
        // Vérifie que le Poney a un $age compris entre 4 et 15 ans
        request()->validator()->rule('PonyAge', function ($DateofBirth) {

            // Calculer l'âge du poney
            $naissance = new DateTime($DateofBirth);
            $today = new DateTime();
            $age = $today->diff($naissance)->y;

            // Vérifier si la clé de contrôle correspond
            return $age >= 4 && $age <= 15;

        }, 'L\'âge du poney doit être compris entre 4 et 15 ans');

        // On prépare la regenération d'un nouveau formulaire
        $temperaments = Temperament::all();
        $titre = 'Créer un nouveau poney';
        $pony = new Pony(request()->postData());

        // On teste les autres données du formulaire
        $validate = request()->validate([
            'DateOfBirth' => 'Date|PonyAge',
            'MaxWorkHour' => 'number',
            'Height' => 'number'
        ]);

        // Si erreur, on renvoie vers le formulaire de création d'un Poney
        if (!$validate) {
            $errors = request()->errors();
            render('pony.create', compact('pony', 'titre', 'temperaments', 'errors'));

        } else {

            // On vérifie qu'il n'existe pas déjà un poney portant le même nom
            try {
                // Création du poney
                Pony::create(request()->postData());
                return redirect(route('ponies.index'));

            } catch (QueryException $e) {
                // Vérification si l'erreur est due à la contrainte d'unicité
                if ($e->errorInfo[1] == 1062) {
                    $errors[] = 'Un poney porte déjà ce nom';
                    render('pony.create', compact('pony', 'titre', 'temperaments', 'errors'));
                }
            }
        }
    }

    /**
     * Supprime un poney basé sur son ID passé en paramètre d'un formulaire
     * @return void
     */
    function destroy()
    {
        $PonyId = $_POST['PonyId'];
        $pony = Pony::findOrFail($PonyId);
        if ($pony) {
            $pony->delete();
        }
        response()->redirect(route('ponies.index'));
    }

}
