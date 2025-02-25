@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('temperaments.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
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
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
                            <button type="submit" class="detailsbutton">
                                <i class="fa fa-user"></i>
                            </button>
                        </form>
                        <form action="{{route('temperaments.edit', $temperament->TemperamentId)}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
                            <button type="submit" class="editbutton">
                                <i class="fa fa-user"></i>
                            </button>
                        </form>
                        <form action="{{route('temperaments.destroy')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="TemperamentId" value="{{$temperament->TemperamentId}}">
                            <button type="submit" class="deletebutton">
                                <i class="fa fa-user"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    <div class="container-footer">
        <a href="{{route('ponies.index')}}">
            <button>Retour</button>
        </a>
    </div>
@endsection
