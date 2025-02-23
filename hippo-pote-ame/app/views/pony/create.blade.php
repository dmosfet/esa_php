@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom du Poney</th>
            <th>Date de naissance</th>
            <th>Hauteur</th>
            <th>Tempérament</th>
            <th>Heures Max/sem</th>
            <th>Action</th>
        </tr>
        <tr>
            <form action="{{ route('ponies.store') }}" method="post">
                @php csrf()->form();  @endphp
                <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
                <td><input type="text" name="Name" id="Name" value="{{$pony->Name}}"></td>
                <td><input type="date" name="DateOfBirth" id="DateOfBirth" value="{{$pony->DateOfBirth}}"></td>
                <td><input type="number" name="Height" id="Height" value="{{$pony->Height}}" min="80" max="150"></td>
                <td>
                    <select name="TemperamentId" id="TemperamentId">
                        @foreach($temperaments as $temperament)
                            <option value="{{$temperament->TemperamentId}}">{{$temperament->Name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="MaxWorkHour" id="MaxWorkHour" value="{{ $pony->MaxWorkHour }}" min="1" max="8">
                </td>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
            </form>
        </tr>
    </table>
    </div>
@endsection
