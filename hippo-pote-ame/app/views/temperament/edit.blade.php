@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Id</th>
                <th>Tempérament</th>
                <th>Action</th>
            </tr>
            @foreach($temperaments as $temperament)
                <tr>
                        <?php csrf()->form(); ?>
                    <form action="{{ route('temperaments.update') }}" method="post">
                            <?php csrf()->form(); ?>
                        <td>
                            <input type="hidden" name="TemperamentId" id="TemperamentId" placeholder="{{$temperament->TemperamentId}}" value="{{$temperament->TemperamentId}}">
                        </td>
                        <td>
                            <input type="text" name="TemperamentName" id="TemperamentName" value="{{$temperament->TemperamentName}}"></td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

