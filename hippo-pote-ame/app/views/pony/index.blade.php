@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <a href="{{route('ponies.create')}}">
            <button class="addbutton"></button>
        </a>
    </div>
    <hr>
    <table>
        <tr>
            <th>Nom du Poney</th>
            <th>Tempérament</th>
            <th>Heures Max/sem</th>
            <th>Heures planifiées</th>
            <th>Heures prestées</th>
            <th>Action</th>
        </tr>
        @foreach($ponies as $pony)
            <tr>
                <td>{{ $pony->Name}}</td>
                <td>{{ $pony->Temperament->Name }}</td>
                <td>{{ $pony->MaxWorkHour }}</td>
                @if ($pony->HourPlanned->count() > 0)
                    <td>{{ $pony->HourPlanned[0]->total_hour_planned}}</td>
                @else
                    <td>0</td>
                @endif
                @if ($pony->HourDone->count() > 0)
                    <td>{{ $pony->HourDone[0]->total_hour_done}}</td>
                @else
                    <td>0</td>
                @endif

                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('ponies.details', $pony->PonyId)}}" method="get">
                            @php csrf()->form(); @endphp
                            <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                            <button type="submit" class="detailsbutton">
                                <i class="fa fa-user"></i>
                            </button>
                        </form>
                        <form action="{{route('ponies.edit')}}" method="post">
                            @php csrf()->form(); @endphp
                            <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                            <button type="submit" class="editbutton"></button>
                        </form>
                        <form action="{{route('ponies.destroy')}}" method="post">
                            @php csrf()->form(); @endphp
                            <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                            <button type="submit" class="deletebutton" onclick="this.form.action = confirm('Êtes-vous sûr de vouloir supprimer ce poney ?') ? this.form.action : event.preventDefault()"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    <nav>
        <div class="navbar">
            <a href='{{$ponies->previousPageUrl()}}'><button class="beforebutton"></button></a>
            @for ($i=1; $i<=$ponies->lastPage(); $i++)
                <a href='/ponies?page={{$i}}'><button class="pagebutton @if($ponies->currentPage() == $i) currentpage @endif">{{$i}}</button></a>
            @endfor
            <a href='{{$ponies->nextPageUrl()}}'><button class="nextbutton"></button></a>
        </div>
    </nav>

@endsection
