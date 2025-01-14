@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <a href="{{route('ponies.edit', $PonyId)}}"><button>Modifier</button></a>
        <a href="{{route('ponies.destroy', $PonyId)}}"><button>Supprimer</button></a>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
            </tr>
            @foreach($ponies as $pony)
                <tr>
                    <td>{{ $pony->PonyName}}</td>
                    <td>{{ $pony->Temperament->TemperamentName }}</td>
                    <td>{{ $pony->PonyMaxWorkHour }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
