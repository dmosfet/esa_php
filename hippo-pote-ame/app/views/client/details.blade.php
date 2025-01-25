@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <td>
                    <form action="{{route('clients.edit')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                        <input type="submit" value="Modifier">
                    </form>
                </td>
                <td>
                    <form action="{{route('clients.destroy')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
                <td>
                    <form action="{{route('clients.index')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="submit" value="Retour">
                    </form>
                </td>
            </tr>
        </table>
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
                    <td>{{ $client->SocietyName }}</td>
                    <td>{{ $client->BCE }}</td>
                    <td></td>
                    <td>{{ $client->LastName }}</td>
                    <td>{{ $client->FirstName }}</td>
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
                    <td>{{ $client->LastName }}</td>
                    <td>{{ $client->FirstName}}</td>
                    <td>{{ date("d/m/Y",strtotime($client->DateOfBirth))}}</td>
                </tr>
            </table>
        <?php endif; ?>
        <h2>Données de contact</h2>
        <table>
            <tr>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
            <tr>
                <td>{{ $client->Email}}</td>
                <td>{{ $client->Telephone}}</td>
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
                    <td>{{ $client->Address}}</td>
                    <td>{{ $client->Number }}</td>
                    <td>{{ $client->ZipCode}}</td>
                    <td>{{ $client->City}}</td>
                </tr>
        </table>
    </div>
@endsection
