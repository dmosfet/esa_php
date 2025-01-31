@extends('layouts.app')

@section('content')
        <hr>
        <div class="container-title">
        <h3>{{ $titre }}</h3>
            <form action="{{route('sessions.edit')}}" method="post">
                <?php csrf()->form(); ?>
                <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                <button type="submit" class="modifybutton"></button>
            </form>
                <form action="{{route('sessions.destroy')}}" method="post">
                    <?php csrf()->form(); ?>
                    <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
                    <button type="submit" class="deletebutton"></button>
                </form>
        </div>
        <hr>
        <table>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Durée</th>
                <th>Participants</th>
            </tr>
                <tr>
                    <td>{{ date("d/m/Y",strtotime($session->DateSession))}}</td>
                    <td>{{ $session->HourSession}}</td>
                    <td>{{ $session->Duration}}</td>
                    <td>{{ $session->Participants }}</td>
                </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td><h3>Clients inscrits</h3></td>
                @if (
                    ($session->SessionTypeId == 1 && $sessionclients->count()<1)
                    ||
                    ($session->SessionTypeId == 2 && $sessionclients->count()< $session->Participants)
                    )
                    <td><a href="{{route('sessionclients.create', $SessionId)}}"><button>Inscrire</button></a></td>
                @endif
            </tr>
        </table>
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
                            <form action="{{route('sessionclients.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="ClientId" value="{{ $sessionclient->ClientId }}"/>
                                <input type="hidden" name="SessionId" value="{{ $sessionclient->SessionId }}"/>
                                <button type="submit">Désinscrire</button>
                            </form>
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
        <table>
            <tr>
                <td><h3>Poneys attribués</h3></td>
                @if ($sessionponies->count()< $session->Participants)
                    <td><a href="{{route('sessionponies.create', $SessionId)}}"><button>Attribuer un poney</button></a></td>
                @endif

             </tr>
        </table>
        <hr>
        <table>
            <tr>
                @if($sessionponies->count() > 0)
                    @foreach($sessionponies as $sessionpony)
                    <tr>
                        <td>{{ $sessionpony->Pony->Name}}</td>
                        <td>{{ $sessionpony->Pony->Temperament->Name}}</td>
                        <td>
                            <form action="{{route('sessionponies.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="PonyId" value="{{ $sessionpony->PonyId }}"/>
                                <input type="hidden" name="SessionId" value="{{ $sessionpony->SessionId }}"/>
                                <button type="submit">Retirer</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                @else
                    <tr>
                        <td><h5>Aucun poney attribué</h5></td>
                    </tr>
                @endif
        </table>
        <div class="container-footer">
            <form action="{{route('sessions.index', 'today')}}" method="post">
                <?php csrf()->form(); ?>
                <input type="submit" value="Retour">
            </form>
        </div>
@endsection

