@php
    use Carbon\Carbon;
    Carbon::setLocale('fr');
    $lastid = 0;
@endphp

@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <div class="calendar">
        <table class="timesheet">
            <tr>
                <th>
                    <form action="{{route('timesheets.index', $mode)}}" method="POST">
                        @php csrf()->form(); @endphp
                        <input type="hidden" id="day" name="day" value="{{$before->format('Y-m-d')}}">
                        <button type=submit class="beforebutton"></button>
                    </form>
                </th>
            </tr>
            @for ($heure = 9; $heure <= 17; $heure++)
                <tr>
                    <td></td>
                </tr>
            @endfor
        </table>
        <table class="timesheet">
            <tr>
                <th>Heure</th>
            </tr>
            @for ($heure = 9; $heure <= 17; $heure++)
                <tr>
                    <td>
                        {{sprintf("%02d:00", $heure)}}
                    </td>
                </tr>
            @endfor
        </table>

        <!--On affiche chaque jour dans un tableau-->
        @foreach ($jours as $jour => $valeur)
            <table class="timesheet">
                <tr>
                    <th>{{ Carbon::parse($jour)->isoFormat('dddd') . " \n " . $jour}}</th>
                </tr>
                @foreach ($valeur as $heure)
                    <tr>
                        @if ($heure['Session'] == '+')
                            <td rowspan="{{$heure['Duree']}}">
                                @if ($mode == 'today')
                                    <form action="{{route('timesheets.index', 'today')}}" method="POST">
                                        @php csrf()->form(); @endphp
                                        <input type="hidden" name="HourSession" id="HourSession"
                                               value="{{$heure['Heure']}}">
                                        <button type="submit" class="addbutton"></button>
                                    </form>
                                @elseif($mode== 'week')
                                    <form action="{{route('sessions.create', 'today')}}" method="GET">
                                        @php csrf()->form(); @endphp
                                        <input type="hidden" name="DateSession" id="DateSession"
                                               value="{{$day->format('Y-m-d')}}">
                                        <input type="hidden" name="HourSession" id="HourSession"
                                               value="{{$heure['Heure']}}">
                                        <button type="submit" class="addbutton"></button>
                                    </form>
                                @endif
                            </td>
                        @else
                            @if ($lastid != $heure['Session'])
                                <td rowspan="{{$heure['Duree']}}"
                                    class="agenda typesession_{{substr($heure['Type'], 0, 3)}}">
                                    <a href="{{route('sessions.details', $heure['Session'])}}">
                                        {{ $heure['Type']}}
                                    </a>
                                </td>
                                @php $lastid = $heure['Session']; @endphp
                            @endif
                        @endif
                    </tr>
                @endforeach
            </table>
            @if ($mode== 'week')
                @php $day->modify('+ 1 day'); @endphp
            @endif
        @endforeach
        <table class="timesheet">
            <tr>
                <th>
                    <form action="{{route('timesheets.index', $mode)}}" method="POST">
                        @php csrf()->form(); @endphp
                        <input type="hidden" id="day" name="day" value="{{$after->format('Y-m-d')}}">
                        <button type=submit class="nextbutton"></button>
                    </form>
                </th>
            </tr>
            @for ($heure = 9; $heure <= 17; $heure++)
                <tr>
                    <td></td>
                </tr>
            @endfor
        </table>
        @if ($mode =='today' && auth()->user()->can(['create sessions', 'create all']))
            <div class="timesheet"></div>
            <form action="{{ route('sessions.store') }}" method="post">
                @php csrf()->form(); @endphp
                <table>
                    <tr>
                        <th><label for id="Duration">Durée</label></th>
                    </tr>
                    <tr>
                        <td>
                            <select id="Duration" name="Duration">
                                <option value="1"> Sélectionnez une durée (1h par défaut)</option>
                                <option value="1">1h</option>
                                <option value="2">2h</option>
                                <option value="3">3h</option>
                                <option value="4">4h</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>Type</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="SessionTypeId" id="SessionTypeId">
                                @foreach($sessiontypes as $sessiontype)
                                    <option
                                        value="{{$sessiontype->SessionTypeId}}">{{$sessiontype->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                </table>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Nombre de participants</th>
                        <th>Action</th>
                    </tr>
                    <tr>

                        <td><input type="date" name="DateSession" id="DateSession"
                                   value="{{$day->format('Y-m-d')}}"></td>
                        <td><input type="time" name="HourSession" id="HourSession"
                                   value="{{isset($_POST['HourSession']) ? $_POST['HourSession'] : " " }}"></td>
                        <td><input type="number" name="Participants" id="Participants"
                                   value=""
                                   min="1" max="8"></td>
                        <td>
                            <button type="submit">Enregistrer</button>
                        </td>
                    </tr>
                </table>
            </form>
    @endif
@endsection
