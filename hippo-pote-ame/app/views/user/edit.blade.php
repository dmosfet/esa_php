@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    @switch ($mode)
        @case('pwd')
            <table>
                <tr>
                    <th>Nouveau mot de passe</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <form action="{{ route('users.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                        <input type="hidden" name="modificationtype" id="modificationtype" value="pwd">
                        <td><input type="password" name="password" id="password" value=""></td>
                        <td><input type="submit"></td>
                    </form>
                </tr>
            </table>
            @break
        @case('roles')
            <table>
                <tr>
                    <th>Rôle à ajouter</th>
                    <th>Rôle à enlever</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <form action="{{ route('users.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                        <input type="hidden" name="modificationtype" id="modificationtype" value="roles">
                        <td>
                            <select name="deleterole" id="deleterole">
                                @foreach($roles as $role=>$permissions)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="addrole" id="addrole">
                                @foreach($roles as $role=>$permissions)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="submit"></td>
                    </form>
                </tr>
            </table>
            @break
        @default
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <form action="{{ route('users.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                        <input type="hidden" name="modificationtype" id="modificationtype" value="all">
                        <td><input type="text" name="username" id="username" value="{{$user->username}}"></td>
                        <td><input type="email" name="email" id="email" value="{{$user->email}}"></td>
                        <td><input type="submit"></td>
                    </form>
                </tr>
            </table>
    @endswitch

@endsection

