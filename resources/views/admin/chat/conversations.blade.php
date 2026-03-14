@extends('tablar::page')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Conversaciones del Chatbot</h3>
    </div>

    <div class="card-body">
        <table class="table table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Session ID</th>
                    <th>Último mensaje</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $i => $s)
                @php
                    $lastMessage = \App\Models\ChatMessage::where('session_id', $s->session_id)->latest()->first();
                @endphp
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $s->session_id }}</td>
                    <td>{{ $lastMessage->message ?? '' }}</td>
                    <td>
                        <a href="{{ route('chats.show', $s->session_id) }}" class="btn btn-primary btn-sm">
                            Ver chat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
