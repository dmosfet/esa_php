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
                            <button type="submit" class="detailsbutton" title="Afficher le client"></button>
                        </a>
                        <form action="{{route('clients.edit')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="ClientId" value="{{$client->ClientId}}">
                            <button type="submit" class="editbutton" title="Modifier le client"></button>
                        </form>
                        <form action="{{route('clients.destroy')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="ClientId" value="{{$client->ClientId}}">
                            <button type="submit" class="deletebutton" title="Supprimer le client"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    @if ($clients->lastPage() >1)
        <navbar>
            <div class="navbar">
                <a href="{{$clients->previousPageUrl()}}">
                    <button class="beforebutton" title="Page précédente"></button>
                </a>
                @for ($i=1; $i<=$clients->lastPage(); $i++)
                    <a href="/clients?page={{$i}}">
                        <button class="pagebutton
                    @if ($clients->currentPage() == $i)
                        currentpage
                    @endif
                    ">{{$i}}</button>
                    </a>
                @endfor
                <a href="{{$clients->nextPageUrl()}}">
                    <button class="nextbutton" title="Page suivante"></button>
                </a>
            </div>
        </navbar>
    @endif
@endsection
