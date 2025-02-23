@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    @switch($type)
        @case ('ponies')
            <table>
                <tr>
                    <th>Nom du Poney</th>
                    <th>Max</th>
                    <th>Planifié</th>
                    <th>Réalisé</th>
                    <th>Utilisation</th>
                </tr>
                @foreach ($datas as $pony)
                    <tr>
                        <td>{{$pony->Name }}</td>
                        <td>{{$pony->MaxWorkHour }}</td>
                        @if ($pony->HourPlanned->count()>0)
                            @php $planned = $pony->HourPlanned[0]->total_hour_planned; @endphp
                        @else
                            @php $planned = 0; @endphp
                        @endif
                        @if ($pony->HourDone->count()>0)
                            @php $done = $pony->HourDone[0]->total_hour_done; @endphp
                        @else
                            @php $done = 0; @endphp
                        @endif
                        <td>{{$planned}}</td>
                        <td>{{$done}}</td>
                        <td>{{($planned + $done)/ $pony->MaxWorkHour * 100 . "%"}}</td>
                    </tr>
                @endforeach
            </table>
            @break
        @case ('invoices')
            <table>
                <tr>
                    <th></th>
                    <th>Payés</th>
                    <th>Non payés</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>Facturés</td>
                    <td>{{$datas['factures_payes'] . " €"}}</td>
                    <td>{{$datas['factures_non_payes'] . " €"}}</td>
                    <td>{{($datas['factures_payes'] + $datas['factures_non_payes']) . " €"}}</td>
                </tr>
                <tr>
                    <td>Non facturés</td>
                    <td>{{$datas['non_factures_payes'] . " €"}}</td>
                    <td>{{$datas['non_factures_non_payes'] . " €"}}</td>
                    <td>{{($datas['non_factures_payes'] + $datas['non_factures_non_payes']) . " €"}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{($datas['factures_payes'] + $datas['non_factures_payes']) . " €"}}</td>
                    <td>{{($datas['factures_non_payes'] + $datas['non_factures_non_payes']) . " €"}}</td>
                    <td>{{($datas['factures_payes'] + $datas['non_factures_payes'] + $datas['factures_non_payes'] + $datas['non_factures_non_payes']) . " €"}}</td>
                </tr>
            </table>
            @break
        @case ('sessions')
            <table>
                <tr>
                    <th>Type</th>
                    <th>Nbre</th>
                    <th>Vides</th>
                    <th>Taux remplissage</th>
                </tr>
                @foreach ($datas as $type=>$session)
                    <tr>
                        <td>{{$type}}</td>
                        <td>{{$session['total']}}</td>
                        <td>{{$session['empty']}}</td>
                        <td>{{$session['medium'] * 100 . "%"}}</td>
                    </tr>
                @endforeach
            </table>
            @break
    @endswitch

@endsection
