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
            <th>Date</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <tr>
            <form action="{{ route('medicals.edit') }}" method="post">
                @php csrf()->form();  @endphp
                <input type="hidden" name="PonyId" id="PonyId" value="{{$record->PonyId}}">
                <td>{{$record->Pony->Name}}</td>
                <td><input type="date" name="Date" id="Date" value="{{$record->Date}}"></td>
                <td><input type="text" name="Description" id="Description" value="{{$record->Description}}"></td>
                <td><button type="submit">Enregistrer</button></td>
            </form>
        </tr>
    </table>
@endsection

