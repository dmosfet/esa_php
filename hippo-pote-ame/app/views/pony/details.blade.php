@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('ponies.edit')}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
            <button type="submit" class="editbutton"></button>
        </form>
        <form action="{{route('ponies.destroy')}}" method="post">
            @php csrf()->form();  @endphp
            <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
            <button type="submit" class="deletebutton" onclick="this.form.action = confirm('Êtes-vous sûr de vouloir supprimer ce poney ?') ? this.form.action : event.preventDefault()"></button>
        </form>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom du Poney</th>
            <th>Date de naissance</th>
            <th>Hauteur (en cm)</th>
            <th>Tempérament</th>
            <th>Heures Max</th>
        </tr>
        <tr>
            <td>{{ $pony->Name}}</td>
            <td>{{ date("d/m/Y",strtotime($pony->DateOfBirth)) }}</td>
            <td>{{ $pony->Height }}</td>
            <td>{{ $pony->Temperament->Name }}</td>
            <td>{{ $pony->MaxWorkHour }}</td>
        </tr>
    </table>
    <div class="container-footer">
        <form action="{{route('ponies.index')}}" method="post">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection
