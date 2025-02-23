@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('invoices.storeall')}}" method="post">
            @php csrf()->form(); @endphp
            <input type="hidden" name="Invoices" id="Invoices"
                   value="{{json_encode($invoices,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)}}">
            <button type="submit" class="invoicebutton" title="Générer les factures pour la période"></button>
        </form>
    </div>
    <hr>
    @if (count($invoices) == 0)
        <h4>Il n'y a pas de sessions de cours non facturées pour la période demandée.</h4>
        <div class="container-footer">
            <form action="{{route('invoices.index', 'all')}}" method="get">
                @php csrf()->form(); @endphp
                <button type="submit">Retour</button>
            </form>
        </div>
    @else
        @foreach ($invoices as $invoice)
            <fieldset class="invoice-proforma">
                <form action="{{route('invoices.store')}}" method="POST">
                    @php csrf()->form(); @endphp
                    <input type="hidden" name="Reference" id="Reference" value="{{$invoice['Reference']}}">
                    <input type="hidden" name="Year" id="Year" value="{{$Year}}">
                    <input type="hidden" name="Month" id="Month" value="{{$Month}}">
                    <input type="hidden" name="ClientId" id="ClientId"
                           value="{{$invoice['ClientId']}}">
                    <legend><h4>Ref: {{$invoice['Reference']}}</h4></legend>
                    <table>
                        <tr>
                            <th>Client</th>
                            <th>Rue</th>
                            <th>Numéro</th>
                            <th>CP</th>
                            <th>Localité</th>
                        </tr>
                        <tr>
                            <td>{{$invoice['ClientName']}}</td>
                            <td>{{$invoice['ClientAddress']}}</td>
                            <td>{{$invoice['ClientNumber']}}</td>
                            <td>{{$invoice['ClientZipCode']}}</td>
                            <td>{{$invoice['ClientCity']}}</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Prix</th>
                            <th>Payé</th>
                        </tr>
                        @php
                            // Extraction des valeurs de la clé "ville"
                            $SessionIds= array_column($invoice['SessionList'], 'SessionId');

                            // Création de la chaîne avec une virgule
                            $SessionIdList = implode(", ", $SessionIds);
                        @endphp

                        <input type="hidden" name="SessionIdList" id="SessionIdList" value="{{$SessionIdList}}">

                        @foreach ($invoice['SessionList'] as $sessionclient)

                            <tr>
                                <td>{{date('d-m-Y', strtotime($sessionclient['DateSession']))}}</td>
                                <td>{{$sessionclient['Price'] . '€'}}</td>
                                <td>{{$sessionclient['Paid'] . ' €'}}</td>
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
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>{{count($invoice['SessionList'])}}</td>
                            <td><input type="text" name="HTVA" id="HTVA" value="{{$invoice['HTVA'] . ' €'}}" readonly>
                            </td>
                            <td><input type="text" name="TVA" id="TVA" value="{{$invoice['TVA'] . ' €'}}" readonly></td>
                            <td><input type="text" name="TVAC" id="TVAC" value="{{$invoice['TVAC'] . ' €'}}" readonly>
                            </td>
                            <td><input type="text" name="Paid" id="Paid" value="{{$invoice['Paid'] . ' €'}}" readonly>
                            </td>
                            <td>{{$invoice['TVAC'] - $invoice['Paid'] . ' €'}}</td>
                            <td>
                                <button type="submit" class="invoicebutton" title="Générer la facture de ce client pour la période demandée"></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        @endforeach
    @endif
@endsection
