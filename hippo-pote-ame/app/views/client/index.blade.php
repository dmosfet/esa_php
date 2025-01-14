@extends('layouts.app')

@section('content')
    <div class="container">
        <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="/clients/create"><button>Créer un nouveau client</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Nom du client</th>
                <th>BCE</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->ClientName}}</td>
                    <td>{{ $client->ClientBCE }}</td>
                    <td>{{ $client->ClientEmail }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <a href="{{route('clients.details', $client->ClientId)}}"><div class="detailsbutton"></div></a>
                            <a href="{{route('clients.edit', $client->ClientId)}}"><div class="modifybutton"></div></a>
                            <a href="{{route('clients.destroy', $client->ClientId)}}"><div class="deletebutton"></div></a>
                        </div>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection
