@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <form action="{{route('invoices.generate')}}" method="post">
        <?php csrf()->form(); ?>
        <h3>Année</h3>
        <input type="number" name="Year" id="Year" min="2024" max="2050">
        <h3>Mois</h3>
        <input type="number" name="Month" id="Month" min="1" max="12">
        <button type="submit">Générer des factures</button>
    </form>
    <table>
        <tr>
            <th>Année</th>
            <th>Mois</th>
            <th>Client</th>
            <th>Date</th>
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
                    <td>{{ $invoice->client->LastName & " " & $invoice->client->FirstName }}</td>
                @endif
                <td>{{ $invoice->DatePaid }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('invoices.details', $invoice->InvoceId)}}" method="get">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="InvoicetId" value="{{$invoice->InvoceId}}">
                            <button type="submit" class="detailsbutton"></button>
                        </form>
                        <form action="{{route('invoices.edit')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="InvoiceId" value="{{$invoice->InvoceId}}">
                            <button type="submit" class="modifybutton"></button>
                        </form>
                        <form action="{{route('invoices.destroy')}}" method="post">
                                <?php csrf()->form(); ?>
                            <input type="hidden" name="InvoiceId" value="{{$invoice->InvoceId}}"> <!-- ID du client -->
                            <button type="submit" class="deletebutton"></button>
                        </form>
                    </div>
                </td>
            </tr>

        @endforeach
    </table>
    </div>
@endsection

