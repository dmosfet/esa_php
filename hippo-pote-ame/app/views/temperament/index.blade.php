@extends('layouts.app')

@section('content')
    <div class="container">
        <br/>
        <h3>{{ $titre }}</h3>
        <div><a href="{{route('temperaments.create')}}"><button>Créer un nouveau temperament</button></a></div>
        <br/>
        <table>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($temperaments as $temperament)
                <tr>
                    <td>{{ $temperament->TemperamentId }}</td>
                    <td>{{ $temperament->Name }}</td>
                    <td class="truncate-txt">{{ $temperament->Description }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <form action="{{route('temperaments.details', $temperament->TemperamentId)}}" method="get">
                                <?php csrf()->form(); ?>
                                <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}"> <!-- ID du client -->
                                <button type="submit" class="detailsbutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                            <form action="{{route('temperaments.edit', $temperament->TemperamentId)}}" method="post">
                                <?php csrf()->form(); ?>
                                <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}"> <!-- ID du client -->
                                <button type="submit" class="modifybutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                            <form action="{{route('temperaments.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}"> <!-- ID du client -->
                                <button type="submit" class="deletebutton">
                                    <i class="fa fa-user"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
