
@extends('tablar::page')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>➕ Nueva respuesta del chatbot</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('chatbot.store') }}">
            @csrf

            <div class="mb-3">
                <label>Trigger (palabra clave)</label>
                <input type="text" name="trigger" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Respuesta</label>
                <textarea name="reply" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Opciones (separadas por coma)</label>
                <input type="text" name="options" class="form-control">
            </div>

            <button class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>
@endsection
