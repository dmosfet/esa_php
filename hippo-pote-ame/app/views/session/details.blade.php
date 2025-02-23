@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('sessions.edit')}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
            <button type="submit" class="editbutton"></button>
        </form>
        <form action="{{route('sessions.destroy')}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
            <button type="submit" class="deletebutton"></button>
        </form>
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
            @php
                $TypeSession = match ((int)$session->SessionTypeId) {
                    1=> 'Groupe',
                    2 => 'Cours collectif',
                    3 => 'Anniversaire',};
            @endphp
            <td>{{isset($session->SessionType->Name) ? $session->SessionType->Name : $TypeSession}}</td>
            <td>{{ date("d/m/Y",strtotime($session->DateSession))}}</td>
            <td>{{ $session->HourSession}}</td>
            <td>{{ $session->Duration}}</td>
            <td>{{ $session->Participants }}</td>
        </tr>
    </table>
    <hr>
    <div class="container-title">
        <h3>Clients inscrits</h3>
        @if (
            (in_array($session->SessionTypeId, array(1,3))  && $sessionclients->count()<1)
            ||
            ($session->SessionTypeId == 2 && $sessionclients->count()< $session->Participants)
            )
            <a href="{{route('sessionclients.create', $session->SessionId, 1)}}">
                <button class="addbutton"></button>
            </a>
            @if ($session->SessionTypeId == 2 && $session->Participants > 1)
                <a href="{{route('sessionclients.create', $session->SessionId, $session->Participants)}}">
                    <button class="addallbutton"></button>
                </a>
            @endif
        @endif
    </div>
    <hr>
    <table>
        @if($sessionclients->count() > 0)
            @if($session->SessionTypeId === 1)
                <tr>
                    <th>Societé</th>
                    <th>BCE</th>
            @else
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    @endif
                    <td>Action</td>
                </tr>
                @foreach($sessionclients as $sessionclient)
                    <tr>
                        @if($session->SessionTypeId === 1)
                            <td>{{ $sessionclient->Client->SocietyName}}</td>
                            <td>{{ $sessionclient->Client->BCE}}</td>
                        @else
                            <td>{{ $sessionclient->Client->LastName}}</td>
                            <td>{{ $sessionclient->Client->FirstName}}</td>
                            <td>{{ date("d/m/Y",strtotime($sessionclient->Client->DateOfBirth))}}</td>
                        @endif
                        <td>
                            <div class="actionbuttonbar">
                                <form action="{{route('sessionclients.edit')}}" method="post">
                                    @php csrf()->form();  @endphp
                                    <input type="hidden" name="ClientId" value="{{ $sessionclient->ClientId }}"/>
                                    <input type="hidden" name="SessionId" value="{{ $sessionclient->SessionId }}"/>
                                    <button type="submit" class="editbutton"></button>
                                </form>
                                <form action="{{route('sessionclients.destroy')}}" method="post">
                                    @php csrf()->form();  @endphp
                                    <input type="hidden" name="ClientId" value="{{ $sessionclient->ClientId }}"/>
                                    <input type="hidden" name="SessionId" value="{{ $sessionclient->SessionId }}"/>
                                    <button type="submit" class="deletebutton"></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td><h5>Aucun client inscrit</h5></td>
                    </tr>
                @endif
    </table>
    <hr>
    <div class="container-title">
        <h3>Poneys attribués</h3>
        @if ($sessionponies->count()< $session->Participants)
            <a href="{{route('sessionponies.create', $SessionId, 1)}}">
                <button class="addbutton"></button>
            </a>
            <a href="{{route('sessionponies.create', $session->SessionId, $session->Participants)}}">
                <button class="addallbutton"></button>
            </a>
        @endif
    </div>
    <hr>
    <table>
        @if($sessionponies->count() > 0)
            <tr>
                <th>Nom</th>
                <th>Tempérament</th>
                <th>Action</th>
            </tr>
            @foreach($sessionponies as $sessionpony)
                <tr>
                    <td>{{ $sessionpony->Pony->Name}}</td>
                    <td>{{ $sessionpony->Pony->Temperament->Name}}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <form action="{{route('sessionponies.destroy')}}" method="post">
                                @php csrf()->form();  @endphp
                                <input type="hidden" name="PonyId" value="{{ $sessionpony->PonyId }}"/>
                                <input type="hidden" name="SessionId" value="{{ $sessionpony->SessionId }}"/>
                                <button type="submit" class="deletebutton"></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <th><h5>Aucun poney attribué</h5></th>
            </tr>
        @endif
    </table>
    <hr>
    <div class="container-footer">
        <form action="{{route('sessions.index', 'today')}}" method="post">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection

