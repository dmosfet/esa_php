<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ assets('css/styles.css') }}">
    <title>Leaf Esa</title>
</head>
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
    @yield('content')
</div>
</body>

    @yield('scripts')

</html>
