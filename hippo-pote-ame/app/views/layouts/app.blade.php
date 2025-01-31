<?php
$route = app()->getRoute();
$data = auth()->data();
$roles = auth()->roles();
?>
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
        <button class="userbutton"></button>
    </a>
    <form action="{{route('auth.logout')}}" method="POST">
        <?php csrf()->form(); ?>
        <button class="logoutbutton"></button>
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
    @if (auth()->user()->is('admin'))
        <a href="/users">
            <button>Utilsateurs</button>
        </a>
        <a href="/all/clients">
            <button>Clients</button>
        </a>
        <a href="{{route('ponies.index')}}">
            <button>Poneys</button>
        </a>
        <a href="/today/sessions">
            <button>Session</button>
        </a>
        <a href="/today/timesheets">
            <button>Agenda</button>
        </a>
        <a href="{{route('invoices.index')}}">
            <button>Facturation</button>
        </a>
        <a href="{{route('kpis.index')}}">
            <button>Statistiques</button>
        </a>
    @elseif(auth()->user()->can('view invoices'))
        <a href="/all/clients">
            <button>Clients</button>
        </a>
        <a href="{{route('invoices.index')}}">
            <button>Facturation</button>
        </a>
    @elseif(auth()->user()->is('booker'))
        <a href="/all/clients">
            <button>Clients</button>
        </a>
        <a href="{{route('timesheets.index')}}">
            <button>Agenda</button>
        </a>
        <a href="/all/sessions">
            <button>Session</button>
        </a>
    @else
    @endif
</div>
<main class="center-panel">
    @switch($route['name'])
        @case ('clients.index')
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
        @case ('ponies.index')
            <a href="/ponies">
                <button>Poneys</button>
            </a>
            <a href="/ponies/medical">
                <button>Dossiers médicaux</button>
            </a>
            <a href="/ponies/temperaments">
                <button>Caractères</button>
            </a>
            @break
        @case ('ponies.details')
            <a href="/{PonyId}/ponies/medical">
                <button>Dossiers médicaux</button>
            </a>
            @break
        @case ('sessions.index')
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
            @break
        @case ('timesheets.index')
            <a href="/today/timesheets">
                <button>Aujourd'hui</button>
            </a>
            <a href="/week/timesheets">
                <button>Cette semaine</button>
            </a>
            @break
        @case ('users.index')
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
            <div class="actionbuttonbar">
                <form action="/users/id/edit" method="post">
                        <?php csrf()->form(); ?>
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit">Identifiants</button>
                </form>
                <form action="/users/pwd/edit" method="post">
                        <?php csrf()->form(); ?>
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit">Mot de passe</button>
                </form>
                <form action="/users/roles/edit" method="post">
                        <?php csrf()->form(); ?>
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
