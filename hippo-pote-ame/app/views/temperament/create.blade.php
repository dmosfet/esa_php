@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Tempérament</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <tr>
                <form action="{{ route('temperaments.store') }}" method="post">
                    @php csrf()->form();  @endphp
                    <td><input type="hidden" name="TemperamentId" id="TemperamentId"
                               value="{{$temperament->TemperamentId}}"></td>
                    <td><input type="text" name="Name" id="Name" value="{{$temperament->Name}}"></td>
                    <td><input type="text" name="Description" id="Description" value="{{$temperament->Description}}">
                    </td>
                    <td>
                        <button type="submit">Enregistrer</button>
                    </td>
                </form>
            </tr>
        </table>
    </div>
@endsection
