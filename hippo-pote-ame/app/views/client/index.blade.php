@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <div><a href="/clients/create"><button>Créer un nouveau client</button></a></div>
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
                        <span>
                            <a href="{{route('clients.edit', $client->ClientId)}}"><button>Modifier</button></a>
                        </span>
                        <span>
                            <form action="{{route('clients.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="ClientId" value="{{ $client->ClientId }}"/>
                                <button type="submit">Supprimer</button>
                            </form>
                        </span>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection
