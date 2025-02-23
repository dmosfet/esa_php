@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('medicals.create')}}">
            <button class="addbutton" title="Ajouter un rapport médical"></button>
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
                <td>{{ date('d-m-Y', strtotime($record->Date)) }}</td>
                <td>{{ $record->Pony->Name }}</td>
                <td class="truncate-txt">{{ $record->Description }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('medicals.edit', $record->TemperamentId)}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="RecordId" value="{{$record->RecordId}}">
                            <button type="submit" class="editbutton" title="Modifier ce rapport médical"></button>
                        </form>
                        <form action="{{route('medicals.destroy')}}" method="post">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="RecordId" value="{{$record->RecordId}}">
                            <button type="submit" class="deletebutton" title="Supprimer ce rapport médical"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    <div class="container-footer">
        @if ($records->lastPage() >1)
            <navbar>
                <div class="navbar">
                    <a href="{{$clients->previousPageUrl()}}">
                        <button class="beforebutton"></button>
                    </a>
                    @for ($i=1; $i<=$clients->lastPage(); $i++)
                        <a href="/ponies?page={{$i}}">
                            <button class="pagebutton
                    @if ($clients->currentPage() == $i)
                        currentpage
                    @endif
                    ">{{$i}}</button>
                        </a>
                    @endfor
                    <a href="{{$clients->nextPageUrl()}}">
                        <button class="nextbutton"></button>
                    </a>
                </div>
            </navbar>
        @endif
        <a href="{{route('ponies.index', 'all')}}">
            <button>Retour</button>
        </a>
    </div>
@endsection
