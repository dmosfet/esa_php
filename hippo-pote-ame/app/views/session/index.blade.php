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
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="detailsbutton"></button>
                        </form>
                        <form action="{{route('sessions.edit')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="editbutton"></button>
                        </form>
                        <form action="{{route('sessions.destroy')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                            <button type="submit" class="deletebutton"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    @if ($sessions->lastPage() >1)
        <div class="navbar">
            <a href="{{$sessions->previousPageUrl()}}">
                <button class="beforebutton"></button>
            </a>
            @for ($i=1; $i<=$sessions->lastPage(); $i++)
                <a href="/all/sessions?page={{$i}}">
                    <button class="pagebutton
                    @if ($sessions->currentPage() == $i)
                        currentpage
                    @endif
                    ">{{$i}}</button>
                </a>
            @endfor
            <a href="{{$sessions->nextPageUrl()}}">
                <button class="nextbutton"></button>
            </a>
        </div>
    @endif
@endsection

