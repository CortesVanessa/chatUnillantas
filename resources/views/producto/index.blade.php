@extends('tablar::page')

@section('title')
    Producto
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
                        {{ __('Producto ') }}
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">

                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal">
    + Nuevo Producto
</button>
    
<form action="{{ route('productos.store') }}" method="POST">
    @csrf

<div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="productoModalLabel">Crear Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('clave') }}</label>
                    {{ Form::text ('clave', old('clave'), [
                        'class' => 'form-control' . ($errors->has('clave') ? ' is-invalid' : ''),
                        'placeholder' => 'Clave',
                        'maxlength' => 5,
                        'pattern' => '[0-9]{5}',
                        'title' => 'La clave debe contener exactamente 5 números',
                        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                    ]) }}
                    {!! $errors->first('clave', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('modelo') }}</label>
                    {{ Form::text('modelo', old('modelo'), [
                        'class' => 'form-control' . ($errors->has('modelo') ? ' is-invalid' : ''),
                        'placeholder' => 'Modelo',
                        'maxlength' => 30,
                        'oninput' => "
                            this.value = this.value
                                .toUpperCase()
                                .replace(/[^A-Z0-9ÁÉÍÓÚÑ ]/g, '')
                                .slice(0,30);
                        "
                    ]) }}
                    {!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('marca') }}</label>
                    {{ Form::text('marca', old('marca'), [
                        'class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : ''),
                        'placeholder' => 'Marca',
                        'maxlength' => 20,
                        'oninput' => "
                            this.value = this.value
                                .toUpperCase()
                                .replace(/[^A-ZÁÉÍÓÚÑ ]/g, '')
                                .slice(0,20);
                        "
                    ]) }}
                    {!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('stock') }}</label>
                    {{ Form::text('stock', old('stock'), [
                        'class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''),
                        'placeholder' => 'Stock',
                        'maxlength' => 15,
                        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').slice(0,15)"
                    ]) }}
                    {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ Form::label('precio') }}</label>
                    {{ Form::number('precio', old('precio'), [
                        'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''),
                        'placeholder' => 'Precio',
                        'min' => '0',
                        'step' => '0.01',
                        'max' => '999999.99',
                        'oninput' => "if(this.value.length > 10) this.value = this.value.slice(0,10);"
                    ]) }}
                    {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>
</form>
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
                            <h3 class="card-title">Producto</h3>
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
										<th>Modelo</th>
										<th>Marca</th>
										<th>Stock</th>
										<th>Precio</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($productos as $producto)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select producto"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $producto->clave }}</td>
											<td>{{ $producto->modelo }}</td>
											<td>{{ $producto->marca }}</td>
											<td>{{ $producto->stock }}</td>
											<td>{{ $producto->precio }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        DETALLES 
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('productos.show',$producto->id) }}">
                                                            VER
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('productos.edit',$producto->id) }}">
                                                            EDITAR
                                                        </a>
                                                        <form
                                                            action="{{ route('productos.destroy',$producto->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('Do you Want to Proceed?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                ELIMINAR
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
                            {!! $productos->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
