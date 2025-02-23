@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('temperaments.edit', $temperament->TemperamentId)}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
            <button type="submit" class="editbutton" title="Modifier un tempérament"></button>
        </form>
        <form action="{{route('temperaments.destroy')}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
            <button type="submit" class="deletebutton" title="Supprimer un tempérament"></button>
        </form>
    </div>
    <hr>
    <table>
        <tr>
            <th>{{ $temperament->Name }}</th>
        </tr>
        <tr>
            <td>Description:</td>
        </tr>
        <tr>
            <td>{{ $temperament->Description }}</td>
        </tr>
    </table>
    <div class="container-footer">
        <form action="{{route('temperaments.index')}}" method="post">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection
