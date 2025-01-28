@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('medicals.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
        <table>
            <tr>
                <th>Date</th>
                <th>Poney</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->Date }}</td>
                    <td>{{ $record->pony->Name }}</td>
                    <td class="truncate-txt">{{ $record->Description }}</td>
                    <td>
                        <div class="actionbuttonbar">
                            <form action="{{route('medicals.edit', $record->TemperamentId)}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="RecordId" value="{{$record->RecordId}}">
                                <button type="submit" class="modifybutton"></button>
                            </form>
                            <form action="{{route('medicals.destroy')}}" method="post">
                                    <?php csrf()->form(); ?>
                                <input type="hidden" name="RecordId" value="{{$record->RecordId}}">
                                <button type="submit" class="deletebutton"></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    <div class="container-footer">
        <a href="{{route('ponies.index')}}">
            <button>Retour</button>
        </a>
    </div>
@endsection
