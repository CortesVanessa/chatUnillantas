
@extends('tablar::page')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>🤖 Chatbot - Respuestas</h3>
        <a href="{{ route('chatbot.create') }}" class="btn btn-primary">+ Nueva respuesta</a>
    </div>

    <div class="card-body">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Trigger</th>
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
                        <a href="{{ route('chatbot.edit', $r->id) }}" class="btn btn-warning btn-sm">Editar</a>
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
