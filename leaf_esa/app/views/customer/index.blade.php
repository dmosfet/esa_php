@extends('layouts.app')

@section('content')
    {{ $titre }}
    <div>
        <button><a href="/customers/create">Créer un nouveau client</a></button>
    </div>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>City</th>
            <th>Action</th>
        </tr>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->FirstName}}</td>
                    <td>{{ $customer->LastName }}</td>
                    <td>{{ $customer->City }}</td>
                    <td>
                        <a href="{{route('customers.edit', $customer->CustomerId)}}"><button>Edit</button></a>
                        <form action="{{route('customers.destroy')}}" method="post">
                            <?php csrf()->form(); ?>
                            <input type="hidden" name="CustomerId" value="{{ $customer->CustomerId }}"/>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach
    </table>

@endsection
