
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_rol') }}</label>
    <div>
        {{ Form::text('nombre_rol', $role->nombre_rol, ['class' => 'form-control' .
        ($errors->has('nombre_rol') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Rol']) }}
        {!! $errors->first('nombre_rol', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">role <b>nombre_rol</b> instruction.</small>
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
