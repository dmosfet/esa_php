@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Type</th>
                <th>Date</th>
                <th>Début</th>
                <th>Participants</th>
                <th>Action</th>
            </tr>
            <tr>
                <form action="{{ route('sessions.store') }}" method="post">
                    <?php csrf()->form(); ?>
                    <label for id="Duration">Durée</label>
                    <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                    <td>
                        <select name="SessionTypeId" id="SessionTypeId">
                            @foreach($sessiontypes as $sessiontype)
                                <option value="{{$sessiontype->SessionTypeId}}">{{$sessiontype->Name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="date" name="DateSession" id="DateSession" value="{{$session->DateSession}}"></td>
                    <td><input type="time" name="HourSession" id="HourSession" value="{{$session->HourSession}}"></td>
                    <select id="Duration" name="Duration">
                        <option value="1"> Sélectionnez une durée (1h par défaut)</option>
                        <option value="1" >1h</option>
                        <option value="2" >2h</option>
                        <option value="3" >3h</option>
                        <option value="4" >4h</option>
                    </select>
                    <td><input type="number" name="Participants" id="Participants" value="{{$session->Participants}}" min="1" max="8"></td>
                    <td><button type="submit">Enregistrer</button></td>
                </form>
            </tr>
        </table>
    </div>
@endsection

