
@extends('tablar::page')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>🤖 Chatbot - Respuestas</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaRespuesta">
    + Nueva respuesta
</button>

<!-- Modal Nueva Respuesta -->
<div class="modal fade" id="modalNuevaRespuesta" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">➕ Nueva respuesta del chatbot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('chatbot.store') }}">
                @csrf

                <div class="modal-body">

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

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


















    </div>

    <div class="card-body">
        <table class="table table">
            <thead>
                <tr>
                    <th>Palabra clave</th>
                    <th>Respuesta</th>
                    <th>Opciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($responses as $r)
                <tr>
                    <td>{{ $r->trigger }}</td>
                    <td>{{ $r->reply }}</td>
                    <td>{{ implode(', ', $r->options ?? []) }}</td>
                    <td>
                     <button 
    class="btn btn-warning btn-sm btnEditar"
    data-id="{{ $r->id }}"
    data-trigger="{{ $r->trigger }}"
    data-reply="{{ $r->reply }}"
    data-options="{{ implode(',', $r->options ?? []) }}"
>
    Editar
</button>

<!-- Modal Editar -->
 <form method="POST" id="formEditar">
    @csrf
    @method('PUT')
<div class="modal fade" id="modalEditarRespuesta" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">✏️ Editar respuesta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="formEditar">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Palabra Clave</label>
                        <input type="text" name="trigger" id="edit_trigger" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Respuesta</label>
                        <textarea name="reply" id="edit_reply" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Opciones</label>
                        <input type="text" name="options" id="edit_options" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        Actualizar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


                        <form action="{{ route('chatbot.destroy', $r->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", function() {

            let id = this.dataset.id;

            document.getElementById("edit_trigger").value = this.dataset.trigger;
            document.getElementById("edit_reply").value = this.dataset.reply;
            document.getElementById("edit_options").value = this.dataset.options;

            let form = document.getElementById("formEditar");
            form.action = "/chatbot/" + id;

            new bootstrap.Modal(document.getElementById("modalEditarRespuesta")).show();
        });
    });

});
</script>