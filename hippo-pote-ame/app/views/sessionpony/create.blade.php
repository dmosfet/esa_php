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
                <form action="{{ route('sessionponies.store', $session->SessionId ) }}" method="post">
                    <?php csrf()->form(); ?>
                    <input type="hidden" name="SessionId" id="SessionId" value="{{ $session->SessionId }}"/>
                    <tr>
                        <th>Nom</th>
                        <th>Temperament</th>
                    </tr>
                    <tr>
                    <td>
                        <select name="PonyId" id="PonyId">
                            @foreach($ponies as $pony)
                                <option value="{{$pony->PonyId}}">{{$pony->Name}} - {{$pony->Temperament->Name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><button type="submit">Attribuer</button></td>
                </form>
            </tr>
        </table>
    </div>
@endsection


