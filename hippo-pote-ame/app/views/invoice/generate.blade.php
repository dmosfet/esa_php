@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    @foreach ($filteredsessionclients as $filteredsessionclient)
            <?php
            if ($filteredsessionclient[0]->Client->ClientTypeId == 1) {
                $client = $filteredsessionclient[0]->Client->SocietyName;
            } else {
                $client = $filteredsessionclient[0]->Client->LastName . " " . $filteredsessionclient[0]->Client->FirstName;
            }
            $Reference = $Year . $Month . "/" . $filteredsessionclient[0]->Client->ClientId . '/' . date('dmY');
            ?>
        <fieldset class="invoice-proforma">
            <form action="{{route('invoices.store')}}" method="POST">
                <?php csrf()->form(); ?>
                <input type="hidden" name="Reference" id="Reference" value="{{$Reference}}">
                <input type="hidden" name="Year" id="Year" value="{{$Year}}">
                <input type="hidden" name="Month" id="Month" value="{{$Month}}">
                <input type="hidden" name="ClientId" id="ClientId"
                       value="{{$filteredsessionclient[0]->Client->ClientId}}">
                <legend><h4>Ref: {{$Reference}}</h4></legend>
                <table>
                    <tr>
                        <th>Client</th>
                        <th>Rue</th>
                        <th>Numéro</th>
                        <th>CP</th>
                        <th>Localité</th>
                    </tr>
                    <tr>
                        <td>{{$client}}</td>
                        <td>{{$filteredsessionclient[0]->Client->Address}}</td>
                        <td>{{$filteredsessionclient[0]->Client->Number}}</td>
                        <td>{{$filteredsessionclient[0]->Client->ZipCode}}</td>
                        <td>{{$filteredsessionclient[0]->Client->City}}</td>
                    </tr>
                </table>
                    <?php
                    $total = 0;
                    $Paid = 0;
                    $nbrsession = 0;
                    $client = "";
                    $SessionIdList = array();
                    ?>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Prix</th>
                        <th>Payé</th>
                    </tr>
                    @foreach ($filteredsessionclient as $sessionclient)
                        <tr>
                            <td>{{date("d/m/Y",strtotime($sessionclient->Session->DateSession))}}</td>
                            <td>{{$sessionclient->Price . '€'}}</td>
                            <td>{{$sessionclient->Paid . ' €'}}</td>
                        </tr>
                            <?php
                            ++$nbrsession;
                            $Paid += $sessionclient->Paid;
                            $total += $sessionclient->Price;
                            $ClientId = $sessionclient->ClientId;
                            $SessionIdList[] = $sessionclient->SessionId;
                            ?>
                    @endforeach
                </table>
                <table>
                    <tr>
                        <th>Total</th>
                        <th>HTVA</th>
                        <th>TVA</th>
                        <th>TVAC</th>
                        <th>Payé</th>
                        <th>Solde</th>
                    </tr>
                    <tr>
                            <?php
                            $solde = $total - $Paid;
                            $TVA = (float)$total * 21 / 100;
                            $HTVA = (float)$total - $TVA;
                            $TVAC = (float)$total;
                            ?>
                        <input type="hidden" name="SessionIdList" id="SessionIdList"
                               value="{{implode(',',$SessionIdList)}}">
                        <td>{{$nbrsession}}</td>
                        <td><input type="text" name="HTVA" id="HTVA" value="{{$HTVA . ' €'}}" readonly></td>
                        <td><input type="text" name="TVA" id="TVA" value="{{$TVA . ' €'}}" readonly></td>
                        <td><input type="text" name="TVAC" id="TVAC" value="{{$TVAC . ' €'}}" readonly></td>
                        <td><input type="text" name="Paid" id="Paid" value="{{$Paid . ' €'}}" readonly></td>
                        <td>{{$solde . ' €'}}</td>
                        <td>
                            <button type="submit" class="invoicebutton"></button>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    @endforeach
@endsection
