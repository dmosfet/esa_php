@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <form action="{{ route('sessions.store') }}" method="post">
        <?php csrf()->form(); ?>
        <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
        <table>
            <tr>
                <th><label for id="Duration">Durée</label></th>
            </tr>
            <tr>
                <td>
                    <select id="Duration" name="Duration">
                        <option value="1"> Sélectionnez une durée (1h par défaut)</option>
                        <option value="1">1h</option>
                        <option value="2">2h</option>
                        <option value="3">3h</option>
                        <option value="4">4h</option>
                    </select>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Type</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Nombre de participants</th>
                <th>Action</th>
            </tr>
            <tr>

                <td>
                    <select name="SessionTypeId" id="SessionTypeId">
                        @foreach($sessiontypes as $sessiontype)
                            <option value="{{$sessiontype->SessionTypeId}}">{{$sessiontype->Name}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="date" name="DateSession" id="DateSession" value="{{$session->DateSession}}"></td>
                <td><input type="time" name="HourSession" id="HourSession" value="{{$session->HourSession}}"></td>
                <td><input type="number" name="Participants" id="Participants" value="{{$session->Participants}}"
                           min="1" max="8"></td>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
            </tr>
        </table>
    </form>

@endsection

