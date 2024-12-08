@extends('layouts.app')

@section('content')
    <h1>Créer un nouvel employe</h1>

    <form action="create" method="post">
        @include ('employee._form')
        <button type="submit">Create</button>
    </form>

@endsection
