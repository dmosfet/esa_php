@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        <table>
            <tr>
                <td>
                    <form action="{{route('ponies.edit')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
                        <input type="submit" value="Modifier">
                    </form>
                </td>
                <td>
                    <form action="{{route('ponies.destroy')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="hidden" name="PonyId" id="PonyId" value="{{$pony->PonyId}}">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
                <td>
                    <form action="{{route('ponies.index')}}" method="post">
                        <?php csrf()->form(); ?>
                        <input type="submit" value="Retour">
                    </form>
                </td>
            </tr>
        </table>
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
    </div>
@endsection
