@php
    $route = app()->getRoute();
    $data = auth()->data();
    $roles = auth()->roles();
@endphp

    <!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="{{ assets('css/styles.css') }}">
    <title>Hippo-Pote-Ame</title>
</head>
<header class="user-menu">
    <div class="ico-hippo"></div>
    <h1>Gestion de l'association Hippo-Pote-Ame</h1>
    <h4>{{$data->user['username']}}</h4>
    <a href="{{ route('dashboard.index') }}">
        <button class="userbutton" title="Afficher l'espace personne de l'utilisateur"></button>
    </a>
    <a href="{{ route('messages.index') }}">
        <button class="messagebutton" title="Afficher les messages de l'utilisateur"></button>
    </a>
    <form action="{{route('auth.logout')}}" method="POST">
        @php csrf()->form();  @endphp
        <button class="logoutbutton" title="Se déconnecter"></button>
    </form>
</header>
@if(isset($errors) && count($errors) >0)
    <dialog open>
        <div class="container">
            @foreach($errors as $error)
                <h4>{{ $error }}</h4>
            @endforeach
            <form method="dialog">
                <button>OK</button>
            </form>
        </div>
    </dialog>
@endif
<body>
<div class="left-panel">
    <a href="{{route('main.index')}}">
        <button>Accueil</button>
    </a>
    @if (auth()->user()->can(['view user','view all']))
        <a href="{{route('users.index','all')}}">
            <button>Utilisateurs</button>
        </a>
    @endif
    @if (auth()->user()->can(['view pony','view all']))
        <a href="{{route('ponies.index')}}">
            <button>Poneys</button>
        </a>
    @endif
    @if(auth()->user()->can(['view clients','view all']))
        <a href="{{route('clients.index', 'all')}}">
            <button>Clients</button>
        </a>
    @endif
    @if(auth()->user()->can(['view invoices','view all']))
        <a href="{{route('invoices.index', 'all')}}">
            <button>Facturation</button>
        </a>
    @endif
    @if(auth()->user()->can(['view sessions','view all']))
        <a href="{{route('sessions.index', 'all')}}">
            <button>Sessions</button>
        </a>
    @endif
    @if(auth()->user()->can(['view timesheets','view all']))
        <a href="{{route('timesheets.index', 'today')}}">
            <button>Agenda</button>
        </a>
    @endif
    @if(auth()->user()->can(['view kpis','view all']))
        <a href="{{route('kpis.index','ponies')}}">
            <button>Indicateurs</button>
        </a>
    @endif
</div>
<main class="center-panel">
    @switch($route['name'])
        @case ('clients.index')
            <hr>
            <a href="/all/clients">
                <button>Clients</button>
            </a>
            <a href="/society/clients">
                <button>Sociétés</button>
            </a>
            <a href="/private/clients">
                <button>Particuliers</button>
            </a>
            @break
        @case ('clients.details')
            <hr>
            <a href="{{route('invoices.index', $client->ClientId)}}">
                <button>Factures</button>
            </a>
            @break
        @case ('ponies.index')
            <hr>
            <a href="/ponies">
                <button>Poneys</button>
            </a>
            <a href="{{route('medicals.index', $PonyId="all")}}">
                <button>Dossiers médicaux</button>
            </a>
            <a href="/ponies/temperaments">
                <button>Caractères</button>
            </a>
            @break
        @case ('ponies.details')
            <hr>
            <a href="{{route('medicals.index', $PonyId)}}">
                <button>Dossiers médicaux</button>
            </a>
            @break
        @case ('kpis.index')
            <hr>
            <a href="{{route('kpis.index','ponies')}}">
                <button>Poneys</button>
            </a>
            <a href="{{route('kpis.index','sessions')}}">
                <button>Sessions</button>
            </a>
            <a href="{{route('kpis.index','invoices')}}">
                <button>Invoices</button>
            </a>
            @break
        @case ('sessions.index')
            <hr>
            <a href="/today/sessions">
                <button>Aujourd'hui</button>
            </a>
            <a href="/all/sessions">
                <button>Toutes</button>
            </a>
            <a href="/groups/sessions">
                <button>Groupes</button>
            </a>
            <a href="/private/sessions">
                <button>Cours collectifs</button>
            </a>
            <a href="/birthday/sessions">
                <button>Anniversaire</button>
            </a>
            @break
        @case ('timesheets.index')
            <hr>
            <a href="/today/timesheets">
                <button>Aujourd'hui</button>
            </a>
            <a href="/week/timesheets">
                <button>Cette semaine</button>
            </a>
            @break
        @case ('users.index')
            <hr>
            <a href="/all/users">
                <button>Tous</button>
            </a>
            @foreach($roles as $keys=>$values)
                <a href="/{{$keys}}/users">
                    @switch($keys)
                        @case ('admin')
                            <button>Administrateur</button>
                            @break
                        @case ('booker')
                            <button>Horairiste</button>
                            @break
                        @case ('accountant')
                            <button>Comptable</button>
                            @break
                        @case ('chiefaccountant')
                            <button>Comptable en chef</button>
                            @break
                        @case ('caretaker')
                            <button>Soigneur</button>
                            @break
                        @case ('animator')
                            <button>Animateur</button>
                            @break
                        @case ('user')
                            <button>Utilisateur</button>
                            @break
                        @case ('guest')
                            <button>Invité</button>
                            @break
                    @endswitch
                </a>
            @endforeach
            @break
        @case ('users.edit')
            <hr>
            <div class="actionbuttonbar">
                <form action="/users/id/edit" method="post">
                    @php csrf()->form();  @endphp
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit">Identifiants</button>
                </form>
                <form action="/users/pwd/edit" method="post">
                    @php csrf()->form();  @endphp
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit">Mot de passe</button>
                </form>
                <form action="/users/roles/edit" method="post">
                    @php csrf()->form();  @endphp
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit">Rôle et permissions</button>
                </form>
            </div>
            @break
        @default
    @endswitch
    @yield('content')
</main>
</body>
@yield('scripts')
<footer>

</footer>
</html>
