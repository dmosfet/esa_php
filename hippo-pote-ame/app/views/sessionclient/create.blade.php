@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
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
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Payé</th>
            </tr>
            <tr>
                <form action="{{ route('sessionclients.store', $session->SessionId ) }}" method="post">
                    <?php csrf()->form(); ?>
                    <input type="hidden" name="SessionId" id="SessionId" value="{{ $session->SessionId }}"/>
                    <td>
                        <select name="ClientId" id="ClientId">
                            @foreach($clients as $client)
                                @if ($session->SessionTypeId === 1 & $client->ClientTypeId === 1):
                                    <option value="{{$client->ClientId}}">{{$client->SocietyName}} - {{$client->BCE}}</option>
                                @elseif($session->SessionTypeId === 2 & $client->ClientTypeId === 2)
                                    <option value="{{$client->ClientId}}">{{$client->FirstName}} - {{$client->LastName}}</option>
                                @else
                                    Aucun client n'existe pour le type de session organisée
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="Price" id="Price" required></td>
                    <td><input type="text" name="Paid" id="Paid" value="Non"></td>
                    <td><button type="submit">Enregistrer</button></td>
                </form>
            </tr>
        </table>
    </div>
@endsection


