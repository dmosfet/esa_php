@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <div><a href="/ponies/create"><button>Créer un nouveau poney</button></a></div>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
                <th>Action</th>
            </tr>
            @foreach($ponies as $pony)
                <tr>
                    <td>{{ $pony->PonyName}}</td>
                    <td>{{ $pony->Temperament->TemperamentName }}</td>
                    <td>{{ $pony->PonyMaxWorkHour }}</td>
                    <td>
                        <span>
                            <a href="{{route('ponies.edit', $pony->PonyId)}}"><button class="modify"></button></a>
                        </span>
                        <span>
                            <form action="{{route('ponies.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="PonyId" value="{{ $pony->PonyId }}"/>
                                <button type="submit" class="delete">Supprimer</button>
                            </form>
                        </span>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection
