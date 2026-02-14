
@extends('tablar::page')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>✏️ Editar respuesta</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('chatbot.update', $chatbot->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Trigger</label>
                <input type="text" name="trigger" class="form-control" value="{{ $chatbot->trigger }}">
            </div>

            <div class="mb-3">
                <label>Respuesta</label>
                <textarea name="reply" class="form-control">{{ $chatbot->reply }}</textarea>
            </div>

            <div class="mb-3">
                <label>Opciones</label>
                <input type="text" name="options" class="form-control" value="{{ implode(',', $chatbot->options ?? []) }}">
            </div>

            <button class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
