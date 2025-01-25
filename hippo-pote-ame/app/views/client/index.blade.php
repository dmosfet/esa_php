@extends('layouts.app')

@section('content')
    <div class="container">
        <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="/clients/create"><button>Créer un nouveau client</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Type</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Societé</th>
                <th>BCE</th>
                <th>Action</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->ClientType->Name}}</td>
                    <td>{{ $client->FirstName}}</td>
                    <td>{{ $client->LastName }}</td>
                    <td>{{ $client->SocietyName }}</td>
                    <td>{{ $client->BCE }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <form action="{{route('clients.details', $client->ClientId)}}" method="get">
                                <?php csrf()->form(); ?>
                                <input type="hidden" name="ClientId" value="{{$client->ClientId}}"> <!-- ID du client -->
                                <button type="submit" class="detailsbutton"></button>
                            </form>
                            <form action="{{route('clients.edit')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="ClientId" value="{{$client->ClientId}}"> <!-- ID du client -->
                                <button type="submit" class="modifybutton"></button>
                            </form>
                            <form action="{{route('clients.destroy')}}" method="post">
                                <?php csrf()->form(); ?>
                                <input type="hidden" name="ClientId" value="{{$client->ClientId}}"> <!-- ID du client -->
                                <button type="submit" class="deletebutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection
