
@extends('tablar::page')
@section('content')
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">

<div class="card">
    <div class="card-header">
        <h3>➕ Nueva respuesta del chatbot</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('chatbot.store') }}">
            @csrf

            <div class="mb-3">
                <label>Palabra Clave</label>
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


</div>
            </div>
        </div>
    </div>
</div>
 
@endsection
