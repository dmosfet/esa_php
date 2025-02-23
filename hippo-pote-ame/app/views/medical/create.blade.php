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
            <form action="{{ route('medicals.store') }}" method="post">
                @php csrf()->form();  @endphp
                <td>
                    <select name="PonyId" id="PonyId">
                        @foreach($ponies as $pony)
                            <option value="{{$pony->PonyId}}">{{$pony->Name}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="date" name="Date" id="Date" value="{{$record->Date}}"></td>
                <td><input type="text" name="Description" id="Description" value="{{$record->Description}}"></td>
                <td><button type="submit">Enregistrer</button></td>
            </form>
        </tr>
    </table>
    <a href="{{route('ponies.index', 'all')}}">
        <button>Annuler</button>
    </a>
@endsection
