@extends('tablar::page')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>🤖 Chat - {{ $session_id }}</h3>
        <a href="{{ route('chats.index') }}" class="btn btn-secondary">⬅ Volver</a>
    </div>

    <div class="card-body" style="background:#f4f6fb; height:500px; overflow-y:auto;">
        @foreach($messages as $msg)
            <div style="margin:10px 0; display:flex; 
                justify-content: {{ $msg->sender == 'user' ? 'flex-end' : 'flex-start' }};">
                
                <div style="
                    padding:10px 15px;
                    border-radius:15px;
                    max-width:60%;
                    background: {{ $msg->sender == 'user' ? '#206bc4' : '#e7f1ff' }};
                    color: {{ $msg->sender == 'user' ? 'white' : 'black' }};
                ">
                    {{ $msg->message }}
                    <div style="font-size:10px; opacity:.6;">
                        {{ $msg->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
