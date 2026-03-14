<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">



<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_sucursal') }}</label>
    <div>
        {{ Form::text('nombre_sucursal', $sucursale->nombre_sucursal, [
    'class' => 'form-control' . ($errors->has('nombre_sucursal') ? ' is-invalid' : ''),
    'placeholder' => 'Nombre Sucursal',
    'maxlength' => 100,
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ ]/gi,'')"
]) }}
{!! $errors->first('nombre_sucursal', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('direccion') }}</label>
    <div>
        {{ Form::text('direccion', $sucursale->direccion, ['class' => 'form-control' .
        ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono') }}</label>
    <div>
       {{ Form::text('telefono', $sucursale->telefono, [
    'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
    'placeholder' => 'Telefono',
    'maxlength' => 10,
    'pattern' => '[0-9]{10}',
    'inputmode' => 'numeric',
    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
]) }}
   
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
 