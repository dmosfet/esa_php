<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
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
<div class="container">
    <fieldset>
        <legend><h3>{{$titre}}</h3></legend>
        <form action="{{route('auth.login')}}" method="POST">
            <?php csrf()->form(); ?>
            <label for="text">Nom d'utilisateur</label>
            <input type="text" name="username" id="username">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password">
            <button type="submit">Se connecter</button>
        </form>
    </fieldset>
    <a href="{{route('auth.register')}}"><button>Créer un nouveau compte</button></a>
</div>
</body>
@yield('scripts')
<footer>

</footer>
</html>

