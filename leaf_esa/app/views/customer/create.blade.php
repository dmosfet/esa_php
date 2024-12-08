@extends('layouts.app')

@section('content')
    <h1>Créer un nouveau client</h1>

    <form action="create" method="post">
        @include ('customer._form')
        <button type="submit">Create</button>
    </form>

@endsection
