@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h2>{{ $titre }}</h2>
            <form action="{{route('clients.edit')}}" method="post">
                <?php csrf()->form(); ?>
                <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                <button type="submit" class="modifybutton"></button>
            </form>
            <form action="{{route('clients.destroy')}}" method="post">
                <?php csrf()->form(); ?>
                <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                <button type="submit" class="deletebutton"></button>
            </form>
    </div>
    <hr>
    <div>
            <?php if ($client->ClientTypeId === 1) : ?>
            <h4>{{ $client->ClientType->Name}}</h4>
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
            <h4>{{ $client->ClientType->Name}}</h4>
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
            <h4>Données de contact</h4>
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
            <h4>Adresse</h4>
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
    <div class="container-footer">
        <form action="{{route('clients.index')}}" method="post">
            <?php csrf()->form(); ?>
            <button type="submit">Retour</button>
        </form>

    </div>
@endsection
