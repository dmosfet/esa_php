@extends('layouts.app')

@section('content')
    <h1>Editer un employe</h1>
    <div class="container">
    <form action="{{ route('employees.update') }}" method="post">
        <input type="hidden" name="EmployeeId" value="{{ $employee->EmployeeId }}"/>
        @include ('employee._form')
        <button type="submit">Update</button>
    </form>
    </div>
@endsection
