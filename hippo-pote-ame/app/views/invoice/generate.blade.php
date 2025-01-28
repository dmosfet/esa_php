@extends('layouts.app')

@section('content')
    <div class="container">
        <p></p>
        <h3>{{ $titre }}</h3>
        @foreach ($filteredsessionclients as $filteredsessionclient)
                <?php
                if ($filteredsessionclient[0]->Client->ClientTypeId == 1) {
                    $client = $filteredsessionclient[0]->Client->SocietyName;
                } else {
                    $client = $filteredsessionclient[0]->Client->LastName . " " . $filteredsessionclient[0]->Client->FirstName;
                }
                $reference = $year . $month ."/". $filteredsessionclient[0]->Client->ClientId . '/' . date('dmY');
                ?>
            <fieldset class="invoice-proforma">
                <legend><h4>Ref: {{$reference}}</h4></legend>
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
                    $paid = 0;
                    $nbrsession = 0;
                    $client = ""
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
                            <td>{{substr($sessionclient->Price,0,-2) . '€'}}</td>
                            <td>{{$sessionclient->Paid . ' €'}}</td>
                                <?php
                                ++$nbrsession;
                                $paid += $sessionclient->Paid;
                                $total += $sessionclient->Price;
                                $ClientId = $sessionclient->ClientId;
                                ?>
                        </tr>
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
                            $solde = $total - $paid;
                            $TVA = (float)$total * 21 /100;
                            $HTVA = (float)$total - $TVA;
                            $TVAC = (float)$total;
                        ?>
                        <td>{{$nbrsession}}</td>
                        <td>{{$HTVA . ' €'}}</td>
                        <td>{{$TVA . ' €'}}</td>
                        <td>{{$TVAC . ' €'}}</td>
                        <td>{{$paid . ' €'}}</td>
                        <td>{{$solde . ' €'}}</td>
                        <td>
                            <div class="actionbuttonbar">
                                <form action="{{route('invoices.create')}}" method="post">
                                        <?php csrf()->form(); ?>
                                    <input type="hidden" name="ClientId" value="{{$ClientId}}">
                                    <button type="submit" class="invoicebutton"></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </fieldset>
        @endforeach

    </div>

@endsection
