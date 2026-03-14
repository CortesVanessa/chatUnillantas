@extends('tablar::page')

@section('title')
    Sucursale
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
                        {{ __('Sucursale ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <button type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalSucursal">
    + Nueva Sucursal
</button>
<div class="modal fade" id="modalSucursal" tabindex="-1" aria-labelledby="modalSucursalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('sucursales.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalSucursalLabel">Crear Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- NOMBRE SUCURSAL -->
                    <div class="mb-3">
                        <label class="form-label">Nombre Sucursal</label>
                        {{ Form::text('nombre_sucursal', old('nombre_sucursal'), [
                            'class' => 'form-control' . ($errors->has('nombre_sucursal') ? ' is-invalid' : ''),
                            'placeholder' => 'Nombre Sucursal',
                            'maxlength' => 100,
                            'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ ]/gi,'')"
                        ]) }}
                        {!! $errors->first('nombre_sucursal', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- DIRECCIÓN -->
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        {{ Form::text('direccion', old('direccion'), [
                            'class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''),
                            'placeholder' => 'Dirección'
                        ]) }}
                        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <!-- TELÉFONO -->
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        {{ Form::text('telefono', old('telefono'), [
                            'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
                            'placeholder' => 'Teléfono',
                            'maxlength' => 10,
                            'pattern' => '[0-9]{10}',
                            'inputmode' => 'numeric',
                            'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                        ]) }}
                        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
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
                            <h3 class="card-title">Sucursale</h3>
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
                                    
										<th>Nombre Sucursal</th>
										<th>Direccion</th>
										<th>Telefono</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($sucursales as $sucursale)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select sucursale"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $sucursale->nombre_sucursal }}</td>
											<td>{{ $sucursale->direccion }}</td>
											<td>{{ $sucursale->telefono }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        DETALLES
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('sucursales.show',$sucursale->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('sucursales.edit',$sucursale->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('sucursales.destroy',$sucursale->id) }}"
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
                            {!! $sucursales->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
