@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
                <th>Action</th>
            </tr>
                <tr>
                        <?php csrf()->form(); ?>
                    <form action="{{ route('ponies.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
                        <td><input type="text" name="PonyName" id="PonyName" value="{{$pony->PonyName}}"></td>
                        <td>
                            <select name="PonyTemperamentId" id="PonyTemperamentId">
                                @foreach($temperaments as $temperament)
                                    <option value="{{$temperament->TemperamentId}}">{{$temperament->TemperamentName}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="PonyMaxWorkHour" id="PonyMaxWorkHour" value="{{ $pony->PonyMaxWorkHour }}">
                        </td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
        </table>
    </div>
@endsection
