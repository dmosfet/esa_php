@extends('layouts.app')

@section('content')
   <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="ponies/create"><button>Créer un nouveau poney</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Nom du Poney</th>
                <th>Tempérament</th>
                <th>Heures Max</th>
                <th>Action</th>
            </tr>
            @foreach($ponies as $pony)
                <tr>
                    <td>{{ $pony->Name}}</td>
                    <td>{{ $pony->Temperament->Name }}</td>
                    <td>{{ $pony->MaxWorkHour }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <form action="{{route('ponies.details', $pony->PonyId)}}" method="get">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="PonyId" value="{{$pony->PonyId}}"> <!-- ID du client -->
                                <button type="submit" class="detailsbutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                            <form action="{{route('ponies.edit')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="PonyId" value="{{$pony->PonyId}}"> <!-- ID du client -->
                                <button type="submit" class="modifybutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                            <form action="{{route('ponies.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="PonyId" value="{{$pony->PonyId}}"> <!-- ID du client -->
                                <button type="submit" class="deletebutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            @endforeach
        </table>

@endsection
