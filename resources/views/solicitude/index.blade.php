@extends('tablar::page')

@section('title')
    Solicitud
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
                        {{ __('Solicitude ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <button type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalSolicitud">
    + Nueva Solicitud
</button>


<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalSolicitudLabel">Nueva Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        {{ Form::text('nombre', old('nombre'), [
                            'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                            'placeholder' => 'Nombre completo',
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ ]/g, '')"
                        ]) }}
                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- CORREO -->
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        {{ Form::email('correo', old('correo'), [
                            'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''),
                            'placeholder' => 'correo@ejemplo.com',
                            'required'
                        ]) }}
                        {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- TELEFONO -->
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        {{ Form::text('telefono', old('telefono'), [
                            'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
                            'placeholder' => 'Ej: 9511234589',
                            'maxlength' => 10,
                            'pattern' => '[0-9]{10}',
                            'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                        ]) }}
                        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- MARCA -->
                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        {{ Form::select('marca', [
                            '' => 'Seleccione una marca',
                            'MICHELIN' => 'MICHELIN',
                            'BFGOODRICH' => 'BFGOODRICH',
                            'UNIROYAL' => 'UNIROYAL',
                            'BRIDGESTONE' => 'BRIDGESTONE'
                        ], old('marca'), [
                            'class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : '')
                        ]) }}
                        {!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- MODELO -->
                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        {{ Form::text('modelo', old('modelo'), [
                            'class' => 'form-control' . ($errors->has('modelo') ? ' is-invalid' : ''),
                            'placeholder' => 'Ej: MICHELIN PILOT SPORT',
                            'maxlength' => 15,
                            'oninput' => "this.value = this.value.toUpperCase()"
                        ]) }}
                        {!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- MEDIDA -->
                    <div class="mb-3">
                        <label class="form-label">Medida</label>
                        {{ Form::text('medida', old('medida'), [
                            'class' => 'form-control' . ($errors->has('medida') ? ' is-invalid' : ''),
                            'placeholder' => 'Ej: 205/55 R16',
                            'maxlength' => 12,
                            'oninput' => "this.value = this.value
                                .toUpperCase()
                                .replace(/[^0-9\\/R ]/g, '')"
                        ]) }}
                        {!! $errors->first('medida', '<div class="invalid-feedback">:message</div>') !!}
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
                            <h3 class="card-title">Solicitude</h3>
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
                                    
										<th>Nombre</th>
										<th>Correo</th>
										<th>Telefono</th>
										<th>Marca</th>
										<th>Modelo</th>
										<th>Medida</th>
                                        <th>status</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($solicitudes as $solicitude)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select solicitude"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $solicitude->nombre }}</td>
											<td>{{ $solicitude->correo }}</td>
											<td>{{ $solicitude->telefono }}</td>
											<td>{{ $solicitude->marca }}</td>
											<td>{{ $solicitude->modelo }}</td>
											<td>{{ $solicitude->medida }}</td>
                                            <td>{{ $solicitude->status }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        ESTADO 
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('solicitudes.show',$solicitude->id) }}">
                                                            VER
                                                        </a>
                   
                                                     <form action="{{ route('solicitudes.cancelar',$solicitude->id) }}" method="POST">
                                                       @csrf
                                                      @method('PUT')

                                                     <button type="submit"
                                                       onclick="return confirm('¿Deseas procesar la cita?')"
                                                        class="dropdown-item text-danger">
                                                               cancelar
                                                                  </button>
                                                        
                                                        
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
                            {!! $solicitudes->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
