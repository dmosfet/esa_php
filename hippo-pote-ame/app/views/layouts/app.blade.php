<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="public\assets\css\styles.css">
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
    <div class="left-panel">
        <a href="{{route('main.index')}}"><button>Accueil</button></a>
        <a href="{{route('clients.index')}}"><button>Gestion des données</button></a>
        <a href="{{route('sessions.index')}}"><button>Agenda</button></a>
        <a href="{{route('billings.index')}}"><button>Facturation</button></a>
    </div>
    <div class="center-panel">
        <h1>Gestion de l'association Hippo-Pote-Ame</h1>
        <a href="{{route('ponies.index')}}"><button>Poneys</button></a>
        <a href="{{route('clients.index')}}"><button>Clients</button></a>
        <a href="{{route('temperaments.index')}}"><button>Tempéraments</button></a>
        <div>
            @yield('content')
        </div>
    </div>

</body>
    @yield('scripts')
<footer>

</footer>
</html>
