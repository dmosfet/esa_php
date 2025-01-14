@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Tempérament</th>
                <th>Action</th>
            </tr>
                <tr>
                        <?php csrf()->form(); ?>
                    <form action="{{ route('temperaments.store') }}" method="post">
                            <?php csrf()->form(); ?>
                        <td>
                            <input type="hidden" name="TemperamentId" id="TemperamentId" value="{{$temperament->TemperamentId}}">
                        </td>
                        <td>
                            <input type="text" name="TemperamentName" id="TemperamentName" value="{{$temperament->TemperamentName}}"></td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
        </table>
    </div>
@endsection
