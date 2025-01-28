@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table class="timesheet">
        <tr>
            <th>
                <form action="{{ route('timesheets.index') }}" method="POST">
                    <?php csrf()->form(); ?>
                    <input type="hidden" name="today" id="today" value="{{$before->format('d-m-Y')}}">
                    <button type="submit" class="beforebutton"></button>
                </form>
            </th>
            <th>Heure</th>
            <!-- On créé une boucle pour les jours dans l'en tête des colonnes -->
            @for ($i=1; $i<=7; $i++)
                <th>{{ $day->format('l')}} {{ $day->format('d-m-Y') }} </th>
                <?php $day->add(DateInterval::createFromDateString('1 day')); ?>
            @endfor
            <!-- On oublie de pas de réinitialiser le jour à lundi pas comme un gros boulet que je suis -->
            <?php $day->sub(DateInterval::createFromDateString('7 day')); ?>
            <th>
                <form action="{{ route('timesheets.index') }}" method="POST">
                    <?php csrf()->form(); ?>
                    <input type="hidden" name="today" id="today" value="{{$after->format('d-m-Y')}}">
                    <button type="submit" class="nextbutton"></button>
                </form>
            </th>
        </tr>
        <?php
        while ($heuredebut <= $heurefin) { ?>
        <tr>
            <td></td>
            <td>{{$heuredebut->format('H:i')}}</td>
            @for ($i=1; $i<=7; $i++)
                    <?php $findsession = false; ?>
                @foreach($sessions as $session)
                    {{--                            <td>{{ $session->DateSession}} - {{$session->HourSession}}
                                                    {{ $day->format('Y-m-d')}} - {{ $heuredebut->format('H:i:s') }}</td>--}}
                    @if($session->DateSession == $day->format('Y-m-d') && $session->HourSession == $heuredebut->format('H:i:s'))
                        <td rowspan="{{$session->Duration}}" class="agenda typesession_{{$session->SessionTypeId}}">
                            <a href="{{route('sessions.details', $session->SessionId)}}">
                                {{ $session->SessionType->Name }}
                            </a>
                        </td>
                            <?php $findsession = True; ?>
                    @endif
                @endforeach
                    <?php
                    if ($findsession == false) {
                        echo '<td></td>';
                    }
                    $day->add(DateInterval::createFromDateString('1 day')); ?>
            @endfor
                <?php $day->sub(DateInterval::createFromDateString('7 day')); ?>
        </tr>
        <?php
        $heuredebut->add(DateInterval::createFromDateString('1 hour'));
    } ?>
@endsection
