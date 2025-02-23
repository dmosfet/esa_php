@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
    </div>
    <hr>
    <table>
        <tr>
            <th>Expéditeur</th>
            <th>Object</th>
            <th>Message</th>
            <th>Date d'envoi</th>
            <th>Action</th>
        </tr>
        @foreach ($messages as $message)
            <tr>
                <td class="@if ($message->Read == 0) nonread @else read @endif truncate-txt">{{ $message->Sender }}</td>
                <td class="@if ($message->Read == 0) nonread @else read @endif truncate-txt">{{ $message->Object }}</td>
                <td class="@if ($message->Read == 0) nonread @else read @endif truncate-txt">{{ $message->Message }}</td>
                <td class="@if ($message->Read == 0) nonread @else read @endif truncate-txt"> {{ $message->created_at }}</td>
                <td>
                    <div class="actionbuttonbar">
                        <form action="{{route('messages.details', $message->MessageId)}}" method="POST">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="MessageId" id="MessageId" value="{{$message->MessageId}}">
                            <button class="detailsbutton" title="Afficher les détails du message"></button>
                        </form>
                        <form action="{{route('messages.readunread')}}" method="POST">
                            @php csrf()->form();  @endphp
                            <input type="hidden" name="MessageId" id="MessageId" value="{{$message->MessageId}}">
                            <button class="checkbutton" title="Passer le message en lu\non lu"></button>
                        </form>
                        <form>
                            <button class="deletebutton" title="Supprimer ce message"></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
