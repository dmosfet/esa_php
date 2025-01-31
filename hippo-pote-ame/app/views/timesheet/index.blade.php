@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <div style="display:flex;">
        <table class="timesheet">
            <tr>
                <th>Heure</th>
                <!-- On créé une boucle pour les jours dans l'en tête des colonnes -->
                @for ($i=1; $i<=$number; $i++)
                    <th>{{ $day->format('l')}} {{ $day->format('d-m-Y') }} </th>
                    <?php $day->add(DateInterval::createFromDateString('1 day')); ?>
                @endfor
                <!-- On oublie de pas de réinitialiser le jour à lundi pas comme un gros boulet que je suis -->
                <?php $day->sub(DateInterval::createFromDateString($number . ' day')); ?>
{{--                @if ($mode =='today')
                        <th>Action</th>
                @endif--}}
            </tr>
            <?php
            while ($heuredebut <= $heurefin) { ?>
            <tr>
                <td>{{$heuredebut->format('H:i')}}</td>
                @for ($i=1; $i<=$number; $i++)
                        <?php $findsession = false; ?>
                    @foreach($sessions as $session)
                        @if($session->DateSession == $day->format('Y-m-d') && $session->HourSession == $heuredebut->format('H:i:s'))
                            <td rowspan="{{$session->Duration}}" class="agenda typesession_{{$session->SessionTypeId}}">
                                <a href="{{route('sessions.details', $session->SessionId)}}">
                                    {{ $session->SessionType->Name }}
                                </a>
                            </td>
                            <?php $findsession = True; ?>
                        @endif
                    @endforeach
                    @if ($findsession == false)
                            <td></td>
                    @endif
{{--                    @if ($mode =='today')
                        <?php
                            $DateSession = $day->format('Y-m-d');
                            $HourSession = $heuredebut->format('H:i')?>
                        <td>
                            <form action="{{route('sessions.create')}}" method="GET">
                                <input type="hidden" name="DateSession" id="DateSession" value="{{$DateSession}}">
                                <input type="hidden" name="HourSession" id="HourSession" value="{{$HourSession}}">
                                <button type="submit" class="addbutton"></button>
                            </form>
                        </td>
                    @endif--}}
                    <?php $day->add(DateInterval::createFromDateString('1 day'));?>
                @endfor
                <?php $day->sub(DateInterval::createFromDateString(($number) .' day'));?>
            </tr>
                <?php $heuredebut->add(DateInterval::createFromDateString('1 hour')); } ?>


        </table>
        @if ($mode =='today')
            <form action="{{ route('sessions.store') }}" method="post">
                <?php csrf()->form(); ?>
                <input type="hidden" name="SessionId" id="SessionId" value="{{$session->SessionId}}">
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
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Nombre de participants</th>
                                <th>Action</th>
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
                                <td><input type="date" name="DateSession" id="DateSession"
                                           value="{{$session->DateSession}}"></td>
                                <td><input type="time" name="HourSession" id="HourSession"
                                           value=""></td>
                                <td><input type="number" name="Participants" id="Participants"
                                           value=""
                                           min="1" max="8"></td>
                                <td>
                                    <button type="submit">Enregistrer</button>
                                </td>
                            </tr>
                        </table>
                    </tr>
                </table>
            </form>
        @endif
    </div>

@endsection
