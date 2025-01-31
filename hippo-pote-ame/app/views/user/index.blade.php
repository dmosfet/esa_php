@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('users.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{trim($user->leaf_auth_user_roles,"[]\"")}}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('users.details', $user->id)}}" method="get">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button type="submit" class="detailsbutton"></button>
                        </form>
                        <form action="/users/id/edit" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <button type="submit" class="modifybutton"></button>
                        </form>
                        <form action="{{route('users.destroy')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="id" value="{{$user->id}}"> <!-- ID du client -->
                            <button type="submit" class="deletebutton"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
