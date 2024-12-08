@extends('layouts.app')

@section('content')
    {{ $titre }}
    <div>
        <button><a href="/employees/create">Créer un nouvel employé</a></button>
    </div>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Title</th>
            <th>Birthdate</th>
            <th>Country</th>
        </tr>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->FirstName}}</td>
                    <td>{{ $employee->LastName }}</td>
                    <td>{{ $employee->Title }}</td>
                    <td>{{ date('d/m/Y',strtotime($employee->BirthDate)) }}</td>
                    <td>{{ $employee->Country }}</td>
                    <td>
                        <a href="{{route('employees.edit', $employee->EmployeeId)}}"><button>Edit</button></a>
                        <form action="{{route('employees.destroy')}}" method="post">
                            <?php csrf()->form(); ?>
                            <input type="hidden" name="EmployeeId" value="{{ $employee->EmployeeId }}"/>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach
    </table>

@endsection
