@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Durée</th>
                <th>Participants</th>
                <th>Action</th>
            </tr>
                <tr>
                    <form action="{{ route('sessions.update') }}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                        <td><input type="date" name="DateSession" id="DateSession" value="{{$session->DateSession}}"></td>
                        <td><input type="time" name="HourSession" id="HourSession" value="{{ $session->HourSession }}"></td>
                        <td><input type="text" name="Duration" id="Duration" value="{{ $session->Duration }}"></td>
                        <td><input type="number" name="Participants" id="Participants" value="{{ $session->Participants }}" min="1" max="8">
                        <td><button type="submit">Enregistrer</button></td>
                    </form>
                </tr>
        </table>
    </div>
@endsection

