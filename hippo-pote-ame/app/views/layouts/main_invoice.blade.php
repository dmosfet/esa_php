@php
$date = DateTime::createFromFormat('!m', $invoice->Month);
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$formatter->setPattern('MMMM');
@endphp
<fieldset class="invoice-proforma">
    <table>
        <tr>
            <th><h4>Ref: {{$invoice->Reference}}</h4></th>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th>Période</th>
            <th>Date de création</th>
            <th>Date de paiement</th>
        </tr>
        <tr>
            <td>{{$formatter->format($date)}} {{$invoice->Year}}</td>
            <td>{{$invoice->created_at->format('d-m-Y')}}</td>
            <td>{{isset($invoice->DatePaid) ? date('d-m-Y', strtotime($invoice->DatePaid)) : ' '}}</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th>Client</th>
            <th>Rue</th>
            <th>Numéro</th>
            <th>CP</th>
            <th>Localité</th>
        </tr>
        <tr>
            @if ($invoice->client->ClientTypeId === 1)
                <td>{{$invoice->client->SocietyName}}</td>
            @else
                <td>{{ $invoice->client->LastName . " " . $invoice->client->FirstName }}</td>
            @endif
            <td>{{$invoice->client->Address}}</td>
            <td>{{$invoice->client->Number}}</td>
            <td>{{$invoice->client->ZipCode}}</td>
            <td>{{$invoice->client->City}}</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Prix</th>
            <th>Payé</th>
        </tr>
        @foreach ($sessionclients as $sessionclient)
            <tr>
                <td>{{date("d/m/Y",strtotime($sessionclient->Session->DateSession))}}</td>
                <td>{{$sessionclient->Session->SessionType->Name}}</td>
                <td>{{$sessionclient->Price . '€'}}</td>
                <td>{{$sessionclient->Paid . ' €'}}</td>
            </tr>
        @endforeach
    </table>
    <hr>
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
            <td>{{$sessionclients->count()}}</td>
            <td>{{$invoice->HTVA . ' €'}}</td>
            <td>{{$invoice->TVA . ' €'}}</td>
            <td>{{$invoice->TVAC . ' €'}}</td>
            <td>{{$invoice->Paid . ' €'}}</td>
            <td>{{($invoice->TVAC - $invoice->Paid) . ' €'}}</td>
        </tr>
    </table>
</fieldset>

