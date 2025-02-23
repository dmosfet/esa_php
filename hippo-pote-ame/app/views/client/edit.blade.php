@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <form action="{{ route('clients.update') }}" method="post">
        @php csrf()->form();  @endphp
        <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
        <input type="hidden" name="ClientTypeId" id="ClientTypeId" value="{{$client->ClientTypeId}}">
        @if ($client->ClientTypeId === 1)
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
                    <td><input type="text" name="SocietyName" id="SocietyName" value="{{$client->SocietyName}}"
                               required></td>
                    <td><input type="text" name="BCE" id="BCE" value="{{$client->BCE}}" required></td>
                    <td></td>
                    <td><input type="text" name="FirstName" id="FirstName" value="{{$client->FirstName}}"></td>
                    <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}"></td>
                </tr>
            </table>
        @else
            <h4>{{ $client->ClientType->Name}}</h4>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                </tr>
                <tr>
                    <td><input type="text" name="LastName" id="LastName" value="{{$client->LastName}}" required></td>
                    <td><input type="text" name="FirstName" id="FirstName" value="{{$client->FirstName}}" required></td>
                    <td><input type="date" name="DateOfBirth" id="DateOfBirth" value="{{$client->DateOfBirth}}"></td>
                </tr>
            </table>
        @endif
        <h4>Données de contact</h4>
        <table>
            <tr>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
            <tr>
                <td><input type="email" name="Email" id="Email" value="{{$client->Email}}"></td>
                <td><input type="text" name="Telephone" id="Telephone" value="{{$client->Telephone}}"></td>
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
                <td><input type="text" name="Address" id="Address" value="{{$client->Address}}"></td>
                <td><input type="text" name="Number" id="Number" value="{{$client->Number}}"></td>
                <td><input type="text" name="ZipCode" id="ZipCode" value="{{$client->ZipCode}}"></td>
                <td><input type="text" name="City" id="City" value="{{$client->City}}"></td>
            </tr>
            <tr>
                <td>
                    <form action="{{route('clients.details', $client->ClientId)}}" method="get">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                        <input type="submit" value="Annuler">
                    </form>
                </td>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
                <td>
                    <button type="reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>
@endsection
