@extends('layouts.app')

@section('content')
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
    <table>
        <tr>
            <th>Rôle</th>
        </tr>
        <tr>
            @foreach ($data->roles as $role)
                <td>{{$role}}</td>
            @endforeach
        </tr>
    </table>
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


@endsection


