<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">

<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $solicitude->nombre, [
    'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
    'placeholder' => 'Nombre completo',
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ ]/g, '')"
]) }}
{!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('correo') }}</label>
    <div>
        {{ Form::email('correo', $solicitude->correo, [
    'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''),
    'placeholder' => 'correo@ejemplo.com',
    'required'
]) }}
{!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono') }}</label>
    <div>
        {{ Form::text('telefono', $solicitude->telefono, [
    'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
    'placeholder' => 'Ej:9511234589',
    'maxlength' => 10,
    'pattern' => '[0-9]{10}',
    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
]) }}
{!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('marca') }}</label>
    <div>
      {{ Form::select('marca', [
    '' => 'Seleccione una marca',
    'MICHELIN' => 'MICHELIN',
    'BFGOODRICH' => 'BFGOODRICH',
    'UNIROYAL' => 'UNIROYAL',
    'BRIDGESTONE' => 'BRIDGESTONE'
], $solicitude->marca, [
    'class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : '')
]) }}

{!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('modelo') }}</label>
    <div>
       {{ Form::text('modelo', $solicitude->modelo, [
    'class' => 'form-control' . ($errors->has('modelo') ? ' is-invalid' : ''),
    'placeholder' => 'Ej:Michelin Pilot Sport 4 S',
    'maxlength' => 15,
    'oninput' => "this.value = this.value.toUpperCase()"
]) }}
{!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('medida') }}</label>
    <div>
        {{ Form::text('medida', $solicitude->medida, [
    'class' => 'form-control' . ($errors->has('medida') ? ' is-invalid' : ''),
    'placeholder' => 'Ej: 205/55 R16',
    'maxlength' => '12',
    'oninput' => "this.value = this.value
        .toUpperCase()
        .replace(/[^0-9\\/R ]/g, '')"
]) }}
{!! $errors->first('medida', '<div class="invalid-feedback">:message</div>') !!}
       
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
 