@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('sessions.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
    <table>
        <tr>
            <th>Type</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Participants</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>

        @foreach($sessions as $session)
            <tr>
                <td>{{ $session->SessionType->Name}}</td>
                <td>{{ date("d/m/Y",strtotime($session->DateSession))}}</td>
                <td>{{ $session->HourSession}}</td>
                <td>{{ $session->Duration}} heure(s)</td>
                <td>{{ $session->Participants}}</td>
                <td>{{ $session->Statut() }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('sessions.details', $session->SessionId)}}" method="get">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="detailsbutton"></button>
                        </form>
                        <form action="{{route('sessions.edit')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="modifybutton"></button>
                        </form>
                        <form action="{{route('sessions.destroy')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="deletebutton"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

