@extends('layouts.app')

@section('content')
   <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="ponies/create"><button>Créer un nouveau poney</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
                <th>Action</th>
            </tr>
            @foreach($ponies as $pony)
                <tr>
                    <td>{{ $pony->PonyName}}</td>
                    <td>{{ $pony->Temperament->TemperamentName }}</td>
                    <td>{{ $pony->PonyMaxWorkHour }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <a href="{{route('ponies.details', $pony->PonyId)}}"><div class="detailsbutton"></div></a>
                            <a href="{{route('ponies.edit', $pony->PonyId)}}"><div class="modifybutton"></div></a>
                            <a href="{{route('ponies.destroy', $pony->PonyId)}}"><div class="deletebutton"></div></a>
                        </div>
                    </td>
                </tr>

            @endforeach
        </table>

@endsection
