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
    <div class="alert alert-danger">
        <ul>
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h1>{{ $titre }}</h1>
</div>
<div>
    <a href="{{route('clients.index')}}"><button>Entrez</button></a>
</div>
</body>
@yield('scripts')
<footer>

</footer>
</html>

