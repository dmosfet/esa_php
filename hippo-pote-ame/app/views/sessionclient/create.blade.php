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
            <td>{{ $session->SessionType->Name }}</td>
            <td>{{ date("d/m/Y",strtotime($session->DateSession)) }}</td>
            <td>{{ $session->HourSession }}</td>
            <td>{{ $session->Duration }}</td>
            <td>{{ $session->Participants }}</td>
        </tr>
    </table>
    <hr>
    <form action="{{ route('sessionclients.store', $session->SessionId ) }}" method="post">
        @php csrf()->form();  @endphp
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Payé</th>
            </tr>

            @for ($i=0; $i<$Number-$reservedclients; $i++)
                <input type="hidden" name="SessionId" id="SessionId" value="{{ $session->SessionId }}"/>
                <tr>
                    <td>
                        <select name="Clients[{{$i}}][ClientId]" id="ClientId">
                            @if($clients->isEmpty())
                                <option disabled>Aucun client disponible</option>
                            @else
                                @foreach($clients as $client)
                                    @if ($client->ClientTypeId === 1)
                                        <option
                                            value="{{$client->ClientId}}">{{ "{$client->SocietyName} - {$client->BCE}" }}
                                        </option>
                                    @elseif($client->ClientTypeId === 2)
                                        <option
                                            value="{{$client->ClientId}}">{{ "{$client->FirstName} {$client->LastName}"}}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </td>
                    @if ($session->SessionTypeId === 1)
                        <td><input type="number" name="Clients[{{$i}}][Price]" id="Price" value="150" min="0" step="1"
                                   required></td>
                    @elseif($session->SessionTypeId === 2)
                        <td><input type="number" name="Clients[{{$i}}][Price]" id="Price" value="20" min="0" step="1"
                                   required></td>
                    @elseif($session->SessionTypeId === 3)
                        <td><input type="number" name="Clients[{{$i}}][Price]" id="Price" value="250" min="0" step="1"
                                   required></td>
                    @endif
                    <td><input type="number" name="Clients[{{$i}}][Paid]" id="Paid" value="0" min="0" step="1"></td>
            @endfor
            <tr>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
            </tr>
        </table>
    </form>
    <hr>
    <div class="container-footer">
        <form action="{{route('sessions.details', $session->SessionId)}}" method="GET">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection
