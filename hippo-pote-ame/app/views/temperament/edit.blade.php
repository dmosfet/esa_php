@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Tempérament</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <tr>
            <form action="{{ route('temperaments.update') }}" method="post">
                @php csrf()->form(); @endphp
                <input type="hidden" name="TemperamentId" id="TemperamentId"
                       placeholder="{{$temperament->TemperamentId}}" value="{{$temperament->TemperamentId}}">
                <td>
                    <input type="text" name="Name" id="Name" value="{{$temperament->Name}}">
                </td>
                <td>
                    <input type="text" name="Description" id="Description" value="{{$temperament->Description}}">
                </td>
                <td>
                    <button type="submit">Enregistrer</button>
                </td>
            </form>
        </tr>
    </table>
@endsection

