@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <a href="{{route('clients.edit', $ClientId)}}"><button>Modifier</button></a>
        <a href="{{route('clients.destroy', $ClientId)}}"><button>Supprimer</button></a>
        <table>
            <tr>
                <th>Nom</th>
                <th>BCE</th>
                <th>Email</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->ClientName}}</td>
                    <td>{{ $client->ClientBCE }}</td>
                    <td>{{ $client->ClientEmail}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
