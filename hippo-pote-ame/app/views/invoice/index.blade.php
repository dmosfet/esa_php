@extends('layouts.app')

@section('content')
    @php $month = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'); @endphp
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    @if (isset($_GET['page']) && $_GET['page'] > 1)

    @else
        <form action="{{route('invoices.generate')}}" method="post">
            @php csrf()->form(); @endphp
            <table>
                <tr>
                    <th>Année</th>
                    <th>Mois</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input type="number" name="Year" id="Year" value="2025" min="2024" max="2050"></td>
                    <td>
                        <select name="Month" id="Month">
                            @for($i=1; $i<13; $i++)
                                <option value="{{$i}}">{{$month[$i-1]}}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <button type="submit">Générer des factures</button>
                    </td>
                </tr>
            </table>
        </form>
    @endif
    <hr>
    <table>
        <tr>
            <th>Année</th>
            <th>Mois</th>
            <th>Client</th>
            <th>Date de création</th>
            <th>Solde</th>
            <th>Date du paiement</th>
            <th>Action</th>
        </tr>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->Year}}</td>
                <td>{{ $invoice->Month}}</td>
                @if ($invoice->client->ClientTypeId === 1)
                    <td>{{$invoice->client->SocietyName}}</td>
                @else
                    <td>{{ $invoice->client->LastName . " " . $invoice->client->FirstName }}</td>
                @endif
                <th>{{ $invoice->created_at->format('d-m-Y') }}</th>
                <th>{{ ($invoice->TVAC - $invoice->Paid) . "€"}}</th>
                <td>{{ isset($invoice->DatePaid) ? date('d-m-Y',strtotime($invoice->DatePaid)) : '' }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('invoices.details', $invoice->InvoiceId)}}" method="get">
                            @php csrf()->form(); @endphp
                            <input type="hidden" name="InvoiceId" value="{{$invoice->InvoiceId}}">
                            <button type="submit" class="detailsbutton" title="Afficher les détails de la facture"></button>
                        </form>
                        <form action="{{route('invoices.edit')}}" method="post">
                            @php csrf()->form(); @endphp
                            <input type="hidden" name="InvoiceId" value="{{$invoice->InvoiceId}}">
                            <button type="submit" class="editbutton" title="Modifier la facture"></button>
                        </form>
                        @if (auth()->user()->can('delete invoices'))
                            <form action="{{route('invoices.destroy')}}" method="post">
                                @php csrf()->form(); @endphp
                                <input type="hidden" name="InvoiceId" value="{{$invoice->InvoiceId}}">
                                <button type="submit" class="deletebutton" title="Supprimer la facture"></button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    @if ($invoices->lastPage() >1)
        <navbar>
            <div class="navbar">
                <a href="{{$invoices->previousPageUrl()}}">
                    <button class="beforebutton"></button>
                </a>
                @for ($i=1; $i<=$invoices->lastPage(); $i++)
                    <a href="/{{$ClientId}}/invoices?page={{$i}}">
                        <button class="pagebutton
                        @if ($invoices->currentPage() == $i)
                            currentpage
                        @endif
                        ">{{$i}}</button>
                    </a>
                @endfor
                <a href="{{$invoices->nextPageUrl()}}">
                    <button class="nextbutton"></button>
                </a>
            </div>
        </navbar>
    @endif
@endsection

