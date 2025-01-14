@extends('layouts.app')

@section('content')
    <div class="container">
        <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="temperaments/create"><button>Créer un nouveau temperament</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
            @foreach($temperaments as $temperament)
                <tr>
                    <td>{{ $temperament->TemperamentId }}</td>
                    <td>{{ $temperament->TemperamentName }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <a href="{{ route('temperaments.details', $temperament->TemperamentId) }}"><div class="detailsbutton"></div></a>
                            <a href="{{ route('temperaments.edit', $temperament->TemperamentId) }}"><div class="modifybutton"></div></a>
                            <a href="{{ route('temperaments.destroy', $temperament->TemperamentId) }}"><div class="deletebutton"></div></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
