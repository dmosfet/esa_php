@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        @if (auth()->user()->can(['create user', 'create all']))
            <a href="{{route('users.create')}}">
                <button class="addbutton"></button>
            </a>
        @endif
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
                        @if (auth()->user()->can(['view users', 'view all']))
                            <form action="{{route('users.details', $user->id)}}" method="get">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="detailsbutton"></button>
                            </form>
                        @endif
                        @if (auth()->user()->can(['edit user', 'edit all']))
                            <form action="/users/id/edit" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="editbutton"></button>
                            </form>
                        @endif
                        @if (auth()->user()->can(['delete user', 'delete all']))
                            <form action="{{route('users.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="deletebutton"></button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    @if ($users->lastPage() > 1)
        <div class="navbar">
            <a href="{{$users->previousPageUrl()}}">
                <button class="beforebutton"></button>
            </a>
            @for ($i=1; $i<=$users->lastPage(); $i++)
                <a href="/users?page={{$i}}">
                    <button class="pagebutton @if ($users->currentPage() == $i) currentpage @endif">{{$i}}</button>
                </a>
            @endfor
            <a href="{{$users->nextPageUrl()}}">
                <button class="nextbutton"></button>
            </a>
        </div>
    @endif
@endsection
