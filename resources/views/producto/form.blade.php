
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('clave') }}</label>
    <div>
        {{ Form::text('clave', $producto->clave, [
    'class' => 'form-control' . ($errors->has('clave') ? ' is-invalid' : ''),
    'placeholder' => 'Clave',
    'maxlength' => 5,
    'pattern' => '[0-9]{5}',
    'title' => 'La clave debe contener exactamente 5 números',
    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
]) }}
{!! $errors->first('clave', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('modelo') }}</label>
    <div>
        {{ Form::text('modelo', $producto->modelo, [
    'class' => 'form-control' . ($errors->has('modelo') ? ' is-invalid' : ''),
    'placeholder' => 'Modelo',
    'maxlength' => 10,
    'oninput' => "
        this.value = this.value
            .toUpperCase()
            .replace(/[^A-Z0-9ÁÉÍÓÚÑ ]/g, '')
            .slice(0,30);
    "
]) }}
{!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('marca') }}</label>
    <div>
        {{ Form::text('marca', $producto->marca, [
    'class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : ''),
    'placeholder' => 'Marca',
    'maxlength' => 10,
    'oninput' => "
        this.value = this.value
            .toUpperCase()
            .replace(/[^A-ZÁÉÍÓÚÑ ]/g, '')
            .slice(0,20);
    "
]) }}
{!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('stock') }}</label>
    <div>
        {{ Form::text('stock', $producto->stock, [
    'class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''),
    'placeholder' => 'Stock',
    'maxlength' => 15,
    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '').slice(0,15)"
]) }}
{!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
     
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('precio') }}</label>
    <div>
        {{ Form::number('precio', $producto->precio, [
    'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''),
    'placeholder' => 'Precio',
    'min' => '0',
    'step' => '0.01',
    'max' => '999999.99',
    'oninput' => "if(this.value.length > 10) this.value = this.value.slice(0,10);"
]) }}
{!! $errors->first('precio', '<div class=\"invalid-feedback\">:message</div>') !!}
        
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
