
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('name') }}</label>
    <div>
        {{ Form::text('name', $user->name, [
    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
    'placeholder' => 'Name',
    'maxlength' => 15,
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
]) }}
{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('apellido_paterno') }}</label>
    <div>
       {{ Form::text('apellido_paterno', $user->apellido_paterno, [
    'class' => 'form-control' . ($errors->has('apellido_paterno') ? ' is-invalid' : ''),
    'placeholder' => 'Apellido Paterno',
    'maxlength' => 15,
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
]) }}
{!! $errors->first('apellido_paterno', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('apellido_materno') }}</label>
    <div>
        {{ Form::text('apellido_materno', $user->apellido_materno, [
    'class' => 'form-control' . ($errors->has('apellido_materno') ? ' is-invalid' : ''),
    'placeholder' => 'Apellido Materno',
    'maxlength' => 15,
    'oninput' => "this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ]/g, '')"
]) }}
{!! $errors->first('apellido_materno', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>


<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email') }}</label>
    <div>
    {{ Form::text('email', $user->email, [
        'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
        'placeholder' => 'Email'
    ]) }}
    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('password') }}</label>
    <div>
        {{ Form::password('password', $user->email, ['class' => 'form-control' .
        ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'password']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        
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
