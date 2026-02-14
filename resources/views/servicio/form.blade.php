
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('clave') }}</label>
    <div>
        {{ Form::text('clave', $servicio->clave, [
    'class' => 'form-control' . ($errors->has('clave') ? ' is-invalid' : ''),
    'placeholder' => 'Clave',
    'maxlength' => 8,
    'pattern' => '[A-Z0-9]{8}',
    'title' => 'La clave debe contener exactamente 8 caracteres (A-Z y 0-9)',
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')"
]) }}
{!! $errors->first('clave', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('servicio') }}</label>
    <div>
        {{ Form::text('servicio', $servicio->servicio, ['class' => 'form-control' .
        ($errors->has('servicio') ? ' is-invalid' : ''), 'placeholder' => 'Servicio']) }}
        {!! $errors->first('servicio', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('precio') }}</label>
    <div>
        {{ Form::text('precio', $servicio->precio, ['class' => 'form-control' .
        ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
        {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        
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
