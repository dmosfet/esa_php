@extends('layouts.app')

@section('content')
    <hr>
    <div class="container-title">
        <h3>{{ $titre }}</h3>
        <form action="{{route('messages.destroy')}}" method="POST">
            @php csrf()->form();  @endphp
            <input type="hidden" name="MessageId" id="MessageId" value="{{$message->MessagId}}">
            <button type="submit" class="deletebutton" title="Supprimer ce message"></button>
        </form>
    </div>
    <hr>
    <div class="messageheader">
        <span>Expéditeur: {{ $message->Sender }}</span>
        <span>Mail: {{$message->sender->email}}</span>
        <span>Date d'envoi: {{$message->sender->created_at}}</span>
    </div>
    <hr>
    <div class="messageobject">
        <span>Objet: {{ $message->Object }}</span>
    </div>
    <hr>
    <div class="message">
        <span>{{ $message->Message }}</span>
    </div>
    <hr>
    <div class="messageaction">
        <a href="{{route('messages.index')}}">
            <button type="submit">Retour</button>
        </a>
    </div>

@endsection
