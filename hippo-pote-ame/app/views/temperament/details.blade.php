@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <a href="{{route('temperaments.edit', $TemperamentId)}}"><button>Modifier</button></a>
        <a href="{{route('temperaments.destroy', $TemperamentId)}}"><button>Supprimer</button></a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tempérament</th>
            </tr>
            @foreach($temperaments as $temperament)
                <tr>
                    <td>{{ $temperament->TemperamentId}}</td>
                    <td>{{ $temperament->TemperamentName }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
