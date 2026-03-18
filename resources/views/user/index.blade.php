@extends('tablar::page')

@section('title')
    User
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('User ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <button type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalUsuario">
    + Nuevo Usuario
</button>
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalUsuarioLabel">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        {{ Form::text('name', old('name'), [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => 'Nombre',
                            'maxlength' => 25,
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
                        ]) }}
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- APELLIDO PATERNO -->
                    <div class="mb-3">
                        <label class="form-label">Apellido Paterno</label>
                        {{ Form::text('apellido_paterno', old('apellido_paterno'), [
                            'class' => 'form-control' . ($errors->has('apellido_paterno') ? ' is-invalid' : ''),
                            'placeholder' => 'Apellido Paterno',
                            'maxlength' => 15,
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
                        ]) }}
                        {!! $errors->first('apellido_paterno', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- APELLIDO MATERNO -->
                    <div class="mb-3">
                        <label class="form-label">Apellido Materno</label>
                        {{ Form::text('apellido_materno', old('apellido_materno'), [
                            'class' => 'form-control' . ($errors->has('apellido_materno') ? ' is-invalid' : ''),
                            'placeholder' => 'Apellido Materno',
                            'maxlength' => 15,
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
                        ]) }}
                        {!! $errors->first('apellido_materno', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        {{ Form::email('email', old('email'), [
                            'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                            'placeholder' => 'Email'
                        ]) }}
                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        {{ Form::password('password', [
                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                            'placeholder' => 'Password'
                        ]) }}
                        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>



                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">USUARIOS</h3>
                        </div>
                        
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                           aria-label="Select all invoices"></th>
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="6 15 12 9 18 15"/>
                                        </svg>
                                    </th>
                                    
										<th>Name</th>
										<th>Email</th>
                                         <th>Status</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select user"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
                                             <td>{{ $user->status }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        DETALLES
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('users.show',$user->id) }}">
                                                            Ver usuario
                                                        </a>
                                                        <form
                                                            action="{{ route('users.activar',$user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('deseas activar al usuario?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                ACTIVAR
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('users.destroy',$user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('deseas desactivar al usuario?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                DESACTIVAR
                                                            </button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td>No Data Found</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $users->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
