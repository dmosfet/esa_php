@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <td>
                    <form action="{{route('temperaments.edit', $temperament->TemperamentId)}}" method="post">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
                        <!-- ID du client -->
                        <input type="submit" value="Modifier">
                    </form>
                </td>
                <td>
                    <form action="{{route('temperaments.destroy')}}" method="post">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
                        <!-- ID du client -->
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
                <td>
                    <form action="{{route('temperaments.index')}}" method="post">
                        @php csrf()->form();  @endphp
                        <input type="submit" value="Retour">
                    </form>
                </td>
            </tr>
        </table>
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
    </div>
@endsection
