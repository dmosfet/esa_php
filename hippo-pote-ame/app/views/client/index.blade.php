@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="/clients/create">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
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
                <td>{{ $client->LastName}}</td>
                <td>{{ $client->FirstName }}</td>
                <td>{{ $client->SocietyName }}</td>
                <td>{{ $client->BCE }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <a href="{{route('clients.details', $client->ClientId)}}">
                            <button type="submit" class="detailsbutton"></button>
                        </a>
                        <form action="{{route('clients.edit')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="ClientId" value="{{$client->ClientId}}">
                            <button type="submit" class="modifybutton"></button>
                        </form>
                        <form action="{{route('clients.destroy')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="ClientId" value="{{$client->ClientId}}">
                            <button type="submit" class="deletebutton"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
