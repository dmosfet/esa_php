<?php

namespace App\Controllers;

use App\Models\Client;

class ClientController extends Controller
{
    /***
     * Prépare les éléments nécessaires à afficher la vue par défaut du menu clients.
     * La requête est filtrée en fonction du type de client défini par le paramètre $type.
     * Les résultats sont paginés. (5 élements par page)
     * @param $type string Permet de filtrer les clients en fonction de leur type:
     *  particulier => 'private'
     *  société => 'society'
     *  tous => 'all' ou NULL (par défaut)
     * @return void
     */
    function index($type = null)
    {
        $page = $_GET['page'] ?? 1;
        $parPage = 5;
        $titre = 'Liste de nos clients';
        if ($type == 'society') {
            $clients = Client::with('ClientType')
                ->where('ClientTypeId', 1)
                ->orderBy('SocietyName', 'ASC')
                ->orderBy('LastName', 'ASC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/society/clients');
        } elseif ($type == 'private') {
            $clients = Client::with('ClientType')
                ->where('ClientTypeId', 2)
                ->orderBy('SocietyName', 'ASC')
                ->orderBy('LastName', 'ASC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/private/clients');
        } else {
            $clients = Client::with('ClientType')
                ->orderBy('SocietyName', 'ASC')
                ->orderBy('LastName', 'ASC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/clients');
        }
        render('client.index', compact('clients', 'titre'));
    }

    /***
     * Prépare les éléments nécessaires à afficher les détails d'un client.
     * @param integer $ClientId  Id du client qui sera affiché.
     * @return void
     */
    function details($ClientId)
    {
        $titre = "Fiche Client";
        $client = Client::with('ClientType')
            ->where('ClientId', $ClientId)
            ->first();
        render('client.details', compact('client', 'titre'));
    }

    /***
     * Préparation des éléments nécessaires à la création d'un formulaire de modification d'un client
     * @return void
     */
    function edit()
    {
        $ClientId = $_POST['ClientId'];
        $titre = 'Modifier un client';
        $client = Client::with('ClientType')
            ->where('ClientId', $ClientId)
            ->first();
        render('client.edit', compact('client', 'titre'));
    }

    /***
     * Enregistre les modifications réalisées sur un client basées sur un formulaire.
     * Vérification de la validité du numéro de BCE. Si erreur, retour vers le formulaire de modification.
     * @return void
     */
    function update()
    {
        request()->validator()->rule('isBCE', function ($BCE) {

            // Vérifier si le numéro a le bon format
            if (!preg_match('/^[0-9]{4}.[0-9]{3}.[0-9]{3}$/', $BCE)) {
                return false;
            }
            // Supprimer tous les caractères non numériques
            $BCE = preg_replace('/\D/', '', $BCE);

            // Extraire les 8 premiers chiffres et les 2 derniers (clé de contrôle)
            $base = substr($BCE, 0, 8);
            $controlKey = substr($BCE, -2);

            // Calculer la clé de contrôle attendue
            $expectedKey = 97 - ($base % 97);

            // Vérifier si la clé de contrôle correspond
            return (int)$controlKey === $expectedKey;

        }, 'Votre numéro {field} n\'es pas une numéro valide: le format est de type 9999.999.999');

        $validate = request()->validate([
            'BCE' => 'isBCE'
        ]);

        if (!$validate) {
            $errors = request()->errors();
            $titre = 'Modifier un nouveau client';
            $client = new Client(request()->postData());
            render('client.edit', compact('client', 'errors', 'titre'));
        } else {
            $data = request()->postData();
            $client = Client::find($data['ClientId']);
            if ($data['ClientTypeId'] === "1"):
                $client->SocietyName = $data['SocietyName'];
                $client->BCE = $data['BCE'];
            else:
                $client->LastName = $data['LastName'];
                $client->FirstName = $data['FirstName'];
                $client->DateOfBirth = $data['DateOfBirth'];
            endif;
            $client->Email = $data['Email'];
            $client->Telephone = $data['Telephone'];
            $client->Address = $data['Address'];
            $client->Number = $data['Number'];
            $client->ZipCode = $data['ZipCode'];
            $client->City = $data['City'];
            $client->save();
            response()->redirect(route('clients.details', $data['ClientId']));
        }
    }

    /***
     * Préparation des éléments nécessaires à la création d'un formulaire de création d'un client
     * @return void
     */
    function create()
    {
        $client = new Client();
        $titre = 'Créer un nouveau client';
        render('client.create', compact('client', 'titre'));
    }

    /***
     * Enregistre un nouveau client basé sur un formulaire.
     * Vérification du numéro de BCE pour les sociétés. Si erreur, retour vers le formulaire.
     * @return void
     */
    function store()
    {
        request()->validator()->rule('isBCE', function ($BCE) {

            // Vérifier si le numéro a le bon format
            if (!preg_match('/^[0-9]{4}.[0-9]{3}.[0-9]{3}$/', $BCE)) {
                return false;
            }
            // Supprimer tous les caractères non numériques
            $BCE = preg_replace('/\D/', '', $BCE);

            // Extraire les 8 premiers chiffres et les 2 derniers (clé de contrôle)
            $base = substr($BCE, 0, 8);
            $controlKey = substr($BCE, -2);

            // Calculer la clé de contrôle attendue
            $expectedKey = 97 - ($base % 97);

            // Vérifier si la clé de contrôle correspond
            return (int)$controlKey === $expectedKey;

        }, 'Votre numéro {field} n\'es pas une numéro valide: le format est de type 9999.999.999');

        // On teste le champ BCE sur base de cette nouvelle règle
        $validate = request()->validate([
            'BCE' => 'isBCE'
        ]);

        // Si erreurs, on retourne les erreurs et on regénère un formulaire.
        if (!$validate) {
            $errors = request()->errors();
            $titre = 'Créer un nouveau client';
            $client = new Client(request()->postData());
            render('client.create', compact('client', 'errors', 'titre'));
        } else {
            $data = request()->postData();
            $client = new Client();
            $client->ClientTypeId = $data['ClientTypeId'];
            if ($data['ClientTypeId'] === "1"):
                $client->SocietyName = $data['SocietyName'];
                $client->BCE = $data['BCE'];
                $client->LastName = $data['LastName'];
                $client->FirstName = $data['FirstName'];
                $client->Email = $data['Email'];
                $client->Telephone = $data['Telephone'];
                $client->Address = $data['Address'];
                $client->Number = $data['Number'];
                $client->ZipCode = $data['ZipCode'];
                $client->City = $data['City'];
            else:
                $client->LastName = $data['LastName'];
                $client->FirstName = $data['FirstName'];
                $client->DateOfBirth = $data['DateOfBirth'];
                $client->Email = $data['Email'];
                $client->Telephone = $data['Telephone'];
                $client->Address = $data['Address'];
                $client->Number = $data['Number'];
                $client->ZipCode = $data['ZipCode'];
                $client->City = $data['City'];
            endif;
            $client->save();
            response()->redirect('/clients');
        }
    }

    /***
     * Suppression d'un client sur base de son ID reçue depuis un paramètre POST
     * @return void
     */
    function destroy()
    {
        $ClientId = $_POST['ClientId'];
        $client = Client::findOrFail($ClientId);
        if ($client) {
            $client->delete();
        }
        response()->redirect(route('clients.index'));;
    }
}
