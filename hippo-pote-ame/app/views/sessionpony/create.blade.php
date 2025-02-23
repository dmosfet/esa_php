@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-tile">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Type</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Participants</th>
        </tr>
        <tr>
            <td>{{ $session->SessionType->Name }}</td>
            <td>{{ date("d/m/Y",strtotime($session->DateSession)) }}</td>
            <td>{{ $session->HourSession }}</td>
            <td>{{ $session->Duration }}</td>
            <td>{{ $session->Participants }}</td>
        </tr>
    </table>
    <hr>
    <form action="{{ route('sessionponies.store', $session->SessionId, $Number ) }}" method="post">
        @php csrf()->form();
        if ($Number > 1):
            $Number = $session->Participants - $reservedponies;
        endif;
        @endphp
        <input type="hidden" name="SessionId" id="SessionId" value="{{ $session->SessionId }}"/>
        <table>
            <tr>
                @for ($i=0; $i<$Number; $i++)
                    <th>Poney</th>
                    <th>
                        <select name="PonyId[]" id="PonyId[]">
                            @foreach($ponies as $pony)
                                <option value="{{$pony->PonyId}}">{{$pony->Name}}
                                    - {{$pony->Temperament->Name}} - h/max :
                                    @if ($pony->HourPlanned->count() > 0)
                                        @if ($pony->HourDone->count() > 0)
                                            {{$pony->HourPlanned[0]->total_hour_planned + $pony->HourDone[0]->total_hour_done}}
                                        @else
                                            {{$pony->HourPlanned[0]->total_hour_planned}}
                                        @endif
                                    @else
                                        @if ($pony->HourDone->count() > 0)
                                            {{$pony->HourDone[0]->total_hour_done}}
                                        @else
                                            0
                                        @endif
                                    @endif
                                    / {{$pony->MaxWorkHour}}
                                </option>
                            @endforeach
                        </select>
                    </th>
            </tr>
            @endfor
            <tr>
                <td colspan="2">
                    <button type="submit">Attribuer</button>
                </td>
            </tr>
        </table>
    </form>
    <hr>
    <div class="container-footer">
        <form action="{{route('sessions.details', $session->SessionId)}}" method="GET">
            @php csrf()->form();  @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection


