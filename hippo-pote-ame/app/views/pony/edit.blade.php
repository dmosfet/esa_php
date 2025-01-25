@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Date de naissance</th>
                <th>Hauteur (en cm)</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
                <th>Action</th>
            </tr>
                <tr>
                    <form action="{{ route('ponies.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
                        <td><input type="text" name="Name" id="Name" value="{{$pony->Name}}"></td>
                        <td><input type="date" name="DateOfBirth" id="DateOfBirth" value="{{$pony->DateOfBirth}}"></td>
                        <td><input type="text" name="Height" id="Height" value="{{$pony->Height}}"></td>
                        <td>
                            <select name="TemperamentId" id="TemperamentId">
                                @foreach($temperaments as $temperament)
                                    <option value="{{$temperament->TemperamentId}}">{{$temperament->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="MaxWorkHour" id="MaxWorkHour" value="{{ $pony->MaxWorkHour }}">
                        </td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
        </table>
    </div>
@endsection
