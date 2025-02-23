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
<header>
</header>
<body>
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
<div class="left-logo"></div>
<div class="authentification">
    <hr>
    <h2>Bienvenue chez Hippo-pote-ame</h2>
    <hr>
    <fieldset>
        <legend><h3>{{$titre}}</h3></legend>
        <form action="{{route('auth.login')}}" method="POST">
            @php csrf()->form(); @endphp
            <label for="text"><h4>Nom d'utilisateur</h4></label>
            <input type="text" name="username" id="username">
            <label for="password"><h4>Mot de passe</h4></label>
            <input type="password" name="password" id="password">
            <button type="submit">Se connecter</button>
        </form>
    </fieldset>
    <a href="{{route('auth.register')}}">
        <button type="submit">Créer un nouveau compte</button>
    </a>
</div>
<div class="right-logo"></div>
</body>
@yield('scripts')
<footer>
</footer>
</html>

