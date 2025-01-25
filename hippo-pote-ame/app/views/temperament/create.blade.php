@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Tempérament</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
                <tr>
                    <form action="{{ route('temperaments.store') }}" method="post">
                        <?php csrf()->form(); ?>
                        <td><input type="hidden" name="TemperamentId" id="TemperamentId" value="{{$temperament->TemperamentId}}"></td>
                        <td><input type="text" name="Name" id="Name" value="{{$temperament->Name}}"></td>
                        <td><input type="text" name="Description" id="Description" value="{{$temperament->Description}}"></td>
                        <td><button type="submit">Enregistrer</button></td>
                    </form>
                </tr>
        </table>
    </div>
@endsection
