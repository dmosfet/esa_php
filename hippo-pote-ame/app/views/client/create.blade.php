@extends('layouts.app')

@section('content')
    <?php
    // Initialiser la variable pour stocker le choix de l'utilisateur concernant le type de client à créer
    $typeclient = $_GET['typeclient'] ?? '1';
    ?>
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <form action="{{ route('clients.create') }}" method="get">
            <?php csrf()->form(); ?>
            <label for="choix">Choisissez le type de client :</label>
            <select id="typeclient" name="typeclient" onchange="this.form.submit()">
                <option value="" <?= $typeclient === '' ? 'selected' : '' ?>>-- Sélectionnez une option --</option>
                <option value="1" <?= $typeclient === '1' ? 'selected' : '' ?>>Société</option>
                <option value="2" <?= $typeclient === '2' ? 'selected' : '' ?>>Particulier</option>
            </select>
            <noscript>
                <button type="submit">Appliquer</button>
            </noscript>
        </form>
        <form action="{{ route('clients.store') }}" method="post">
            <?php csrf()->form(); ?>
            <input type="hidden" name="ClientTypeId" id="ClientTypeId" value="{{$typeclient}}">
            <h2>Identifiants</h2>
            <table>
                <tr>
                    <?php if ($typeclient === '1'): ?>
                    <!-- Champs pour Option 1 uniquement -->
                        <th>Societé</th>
                        <th>BCE</th>
                        <th>Représenté par</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                    <?php else: ?>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                    <?php endif; ?>

                </tr>
                <tr>
                    <?php if ($typeclient === '1'): ?>
                    <!-- Champs pour Option 1 uniquement -->
                        <td><input type="text" name="SocietyName" id="SocietyName" value="{{$client->SocietyName}}"></td>
                        <td><input type="text" name="BCE" id="BCE" value="{{$client->BCE}}"></td>
                        <td></td>
                        <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}"></td>
                        <td><input type="text" name="FirstName" id="Firstname" value="{{$client->Firstname}}"></td>
                    <?php else: ?>
                        <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}"></td>
                        <td><input type="text" name="FirstName" id="Firstname" value="{{$client->Firstname}}"></td>
                        <td><input type="date" name="DateOfBirth" id="DateOfBirth" value="{{$client->DateOfBirth}}"></td>
                    <?php endif; ?>
                </tr>
            </table>
            <h2>Contact</h2>
            <table>
                <tr>
                    <th>Email</th>
                    <th>Telephone</th>
                </tr>
                <tr>
                    <td><input type="email" name="Email" id="Email" value="{{$client->Email}}"></td>
                    <td><input type="text" name="Telephone" id="Telephone" value="{{$client->Telephone}}"></td>
                </tr>
            </table>
            <h2>Adresse</h2>
            <table>
                <tr>
                    <th>Rue</th>
                    <th>Numéro</th>
                    <th>Code postal</th>
                    <th>Localité</th>
                </tr>
                <tr>
                    <td><input type="text" name="Address" id="Address" value="{{$client->Address}}"></td>
                    <td><input type="text" name="Number" id="Number" value="{{$client->Number}}"></td>
                    <td><input type="text" name="ZipCode" id="ZipCode" value="{{$client->ZipCode}}"></td>
                    <td><input type="text" name="City" id="City" value="{{$client->City}}"></td>
                </tr>
                <tr>
                    <td><button type="submit">Enregistrer</button></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
