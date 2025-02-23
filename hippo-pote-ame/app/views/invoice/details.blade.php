@extends('layouts.app')

@section('content')
    @php
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        $formatter->setPattern('EEEE');
    @endphp
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('invoices.pdf', $invoice->InvoiceId)}}" method="get">
            @php csrf()->form(); @endphp
            <button type="submit" class="pdfbutton" title="Générer la facture en pdf"></button>
        </form>
        @if (!$invoice->DatePaid)
            <div>
                <a href="{{ route('invoices.paid', $invoice->InvoiceId) }}">
                    <button type="submit" class="lockbutton" title="Clôturer la facture"></button>
                </a>
            </div>
        @endif
        @if (auth()->user()->can('delete invoices'))
            <form action="{{route('invoices.destroy')}}" method="post">
                @php csrf()->form(); @endphp
                <input type="hidden" name="InvoiceId" value="{{$invoice->InvoiceId}}">
                <button type="submit">Supprimer</button>
            </form>
        @endif
    </div>
    <hr>
    @include('layouts.main_invoice')
    <div class="container-footer">
        <form action="{{route('invoices.index','all')}}" method="get">
            @php csrf()->form(); @endphp
            <button type="submit">Retour</button>
        </form>
    </div>
@endsection
