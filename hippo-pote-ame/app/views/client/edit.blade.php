@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <form action="{{route('clients.details', $client->ClientId)}}" method="get">
            <?php csrf()->form(); ?>
            <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
            <input type="submit" value="Annuler">
        </form>
        <p></p>
        <form action="{{ route('clients.update') }}" method="post">
        <?php csrf()->form(); ?>
            <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
            <input type="hidden" name="ClientTypeId" id="ClientTypeId" value="{{$client->ClientTypeId}}">
        <?php if ($client->ClientTypeId === 1) : ?>
            <h2>{{ $client->ClientType->Name}}</h2>
            <table>
                <tr>
                    <th>Nom de la société</th>
                    <th>BCE</th>
                    <th>Représentée par:</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
                <tr>
                    <td><input type="text" name="SocietyName" id="SocietyName" value="{{$client->SocietyName}}"></td>
                    <td><input type="text" name="BCE" id="BCE" value="{{$client->BCE}}"></td>
                    <td></td>
                    <td><input type="text" name="FirstName" id="FirstName" value="{{$client->FirstName}}"></td>
                    <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}"></td>
            </tr>
            </table>
           <?php else: ?>
            <h2>{{ $client->ClientType->Name}}</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                </tr>
                <tr>
                    <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}"></td>
                    <td><input type="text" name="FirstName" id="FirstName" value="{{$client->FirstName}}"></td>
                    <td><input type="date" name="DateOfBirth" id="DateOfBirth" value="{{$client->DateOfBirth}}"></td>
                </tr>
            </table>
            <?php endif; ?>
            <h2>Données de contact</h2>
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
                    <th>CP</th>
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
                    <td><button type="reset">Reset</button></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
