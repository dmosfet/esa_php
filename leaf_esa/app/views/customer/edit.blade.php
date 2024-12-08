@extends('layouts.app')

@section('content')
    <h1>Editer un nouveau client</h1>
    <div class="container">
    <form action="{{ route('customers.update') }}" method="post">
        <input type="hidden" name="CustomerId" value="{{ $customer->CustomerId }}"/>
        @include ('customer._form')
        <button type="submit">Update</button>
    </form>
    </div>
@endsection
