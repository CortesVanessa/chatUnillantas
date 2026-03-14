@extends('tablar::page')

@section('title')
    Servicio
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
                        {{ __('Servicio ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                 <div class="col-12 col-md-auto ms-auto d-print-none">
             <button type="button"
        class="btn btn-primary"data-bs-toggle="modal"data-bs-target="#modalServicio">
    + Nuevo Servicio
</button>

<div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="modalServicioLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('servicios.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalServicioLabel">Crear Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- CLAVE -->
                    <div class="mb-3">
                        <label class="form-label">Clave</label>
                        {{ Form::text('clave', old('clave'), [
                            'class' => 'form-control' . ($errors->has('clave') ? ' is-invalid' : ''),
                            'placeholder' => 'Clave',
                            'maxlength' => 8,
                            'pattern' => '[A-Z0-9]{8}',
                            'title' => 'La clave debe contener exactamente 8 caracteres (A-Z y 0-9)',
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')"
                        ]) }}
                        {!! $errors->first('clave', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- SERVICIO -->
                    <div class="mb-3">
                        <label class="form-label">Servicio</label>
                        {{ Form::text('servicio', old('servicio'), [
                            'class' => 'form-control' . ($errors->has('servicio') ? ' is-invalid' : ''),
                            'placeholder' => 'Servicio'
                        ]) }}
                        {!! $errors->first('servicio', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- PRECIO -->
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        {{ Form::number('precio', old('precio'), [
                            'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''),
                            'placeholder' => 'Precio',
                            'min' => '0',
                            'step' => '0.01'
                        ]) }}
                        {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
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
                            <h3 class="card-title">Servicio</h3>
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
                                    
										<th>Clave</th>
										<th>Servicio</th>
										<th>Precio</th>
                                       

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($servicios as $servicio)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select servicio"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $servicio->clave }}</td>
											<td>{{ $servicio->servicio }}</td>
											<td>{{ $servicio->precio }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                       DETALLES
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('servicios.show',$servicio->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('servicios.edit',$servicio->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('servicios.destroy',$servicio->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('Do you Want to Proceed?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                Eliminar
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
                            {!! $servicios->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
