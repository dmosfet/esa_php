@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Action</th>
        </tr>
        <tr>
            <form action="{{ route('users.store') }}" method="post">
                <?php csrf()->form(); ?>
                <input type="hidden" name="id" id="id" value="{{$user->id}}">
                <td><input type="text" name="username" id="username" value="{{$user->username}}"></td>
                <td><input type="email" name="email" id="email" value="{{$user->email}}"></td>
                <td><input type="password" name="password" id="password" value="{{$user->password}}"></td>
                <td><button type="submit">Enregistrer</button></td>
            </form>
        </tr>
    </table>
@endsection
