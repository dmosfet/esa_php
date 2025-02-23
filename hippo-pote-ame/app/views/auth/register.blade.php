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
<div class="container">
    <hr>
    <h2>Bienvenue chez Hippo-pote-ame</h2>
    <hr>
    <fieldset>
        <legend><h3>{{$titre}}</h3></legend>
        <form action="{{route('auth.register')}}" method="POST">
            @php csrf()->form(); @endphp
            <label for="Name"><h4>Nom</h4></label>
            <input type="text" name="username" id="username">
            <label for="email"><h4>Email</h4></label>
            <input type="email" name="email" id="email">
            <input type="hidden" name="role" id="Role" value="0">
            <label for="password"><h4>Mot de passe</h4></label>
            <input type="password" name="password" id="password">
            <button type="submit">Créer un compte</button>
        </form>
    </fieldset>
</div>
<div class="right-logo"></div>
</body>
@yield('scripts')
<footer>
</footer>
</html>


