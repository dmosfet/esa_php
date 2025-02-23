@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Type</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Participants</th>
        </tr>
        <tr>
            <td>{{ $sessionclient->session->SessionType->Name }}</td>
            <td>{{ date("d/m/Y",strtotime($sessionclient->session->DateSession)) }}</td>
            <td>{{ $sessionclient->session->HourSession }}</td>
            <td>{{ $sessionclient->session->Duration }}</td>
            <td>{{ $sessionclient->session->Participants }}</td>
        </tr>
    </table>
    <form action="{{ route('sessionclients.update') }}" method="post">
        @php csrf()->form();  @endphp
        <input type="hidden" name="SessionId" id="SessionId" value="{{ $sessionclient->SessionId }}"/>
        <input type="hidden" name="ClientId" id="ClientId" value="{{ $sessionclient->ClientId }}"/>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Payé</th>
            </tr>
            <tr>
                @if ($sessionclient->client->ClientTypeId === 1)
                    <td>{{$sessionclient->client->SocietyName  . " - " . $sessionclient->client->BCE}}</td>
                @elseif($sessionclient->client->ClientTypeId === 2)
                    <td>{{$sessionclient->client->FirstName . " " . $sessionclient->client->LastName}}</td>
                @endif
                <td><input type="number" name="Price" id="Price" value="{{$sessionclient->Price}}" min="0" step="1"
                           required></td>
                <td><input type="number" name="Paid" id="Paid" value="{{$sessionclient->Paid}}" min=0 step="1"></td>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
            </tr>
        </table>
    </form>
    <hr>
    <div class="container-footer">
        <form action="{{route('sessions.details', $sessionclient->SessionId)}}" method="GET">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection
