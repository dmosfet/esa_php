@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('users.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <table>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date de création</th>
            <th>Date de mise à jour</th>
            <th>Rôle</th>
        </tr>
        @foreach($users as $user)
                <?php
                $data = auth()->find($user['id']);
                $roles = auth()->user()->roles();
                ?>
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>{{trim($user->leaf_auth_user_roles,"[]\"")}}</td>
            </tr>
        @endforeach
    </table>
@endsection
