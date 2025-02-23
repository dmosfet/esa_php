@extends('layouts.app')

@section('content')
    @php
        $mode=$_POST['mode'] ?? 'null';
    @endphp

    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date de création</th>
            <th>Date de mise à jour</th>
        </tr>
        <tr>
            <td>{{$data->user['username']}}</td>
            <td>{{$data->user['email']}}</td>
            <td>{{$data->user['created_at']}}</td>
            <td>{{$data->user['updated_at']}}</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th>Rôle</th>
            <th>
                <form action="{{route('dashboard.index')}}" method="POST">
                    @php csrf()->form(); @endphp
                    <input type="hidden" name="mode" id="mode" value="addrole">
                    <button class="addbutton" title="Ajouter un rôle"></button>
                </form>
            </th>
        </tr>
        <tr>
            @foreach ($data->roles as $role)
                <td>{{$role}}</td>
            @endforeach
            <td></td>
        </tr>
    </table>
    @if ($mode=='addrole')
        <table>
            <form action="{{route('messages.updaterole')}}" method="POST">
                @php csrf()->form(); @endphp
                <input type="hidden" name="username" id="username" value="{{$data->user['username']}}">
                <select name="role" id="role">
                    <option selected>aucun</option>
                    @foreach($roles as $role=>$permissions)
                        <option value="{{$role}}">{{$role}}</option>
                    @endforeach
                </select>
                <button type="submit">Demander</button>
            </form>
        </table>
    @endif
    <hr>
    <table>
        <tr>
            <th>Permissions</th>
        </tr>
        @foreach ($data->permissions as $permissions)
            <tr>
                <td>{{$permissions}}</td>
            </tr>
        @endforeach
    </table>
    <hr>
@endsection
