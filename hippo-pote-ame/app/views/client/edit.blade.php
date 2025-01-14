@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <th>Nom</th>
                <th>BCE</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <?php csrf()->form(); ?>
                    <form action="{{ route('clients.update') }}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="ClientId" id="ClientId" value="{{$client->ClientId}}">
                        <td>
                            <input type="text" name="ClientName" id="ClientName" value="{{$client->ClientName}}">
                        </td>
                        <td>
                            <input type="text" name="ClientBCE" id="ClientBCE" value="{{ $client->ClientBCE }}">
                        </td>
                        <td>
                            <input type="text" name="ClientEmail" id="ClientEmail" value="{{ $client->ClientEmail }}">
                        </td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
