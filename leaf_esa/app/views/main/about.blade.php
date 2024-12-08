@extends('layouts.app')

@section('content')
    {{ $message }}
    <a href="/">Home</a>
@endsection

@section('scripts')
    <script> src="{{ assets('js/app.js') }}"</script>
@endsection
