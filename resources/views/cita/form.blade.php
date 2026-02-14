
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $cita->nombre, [
    'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
    'placeholder' => 'Nombre',
    'maxlength' => 40,
    'oninput' => "
        this.value = this.value
            .toUpperCase()
            .replace(/[^A-ZÁÉÍÓÚÑ ]/g, '')
            .slice(0,40);
    "
]) }}
{!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('correo') }}</label>
    <div>
        {{ Form::email('correo', $cita->correo, [
    'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''),
    'placeholder' => 'correo@ejemplo.com',
    'maxlength' => 100,
    'required'
]) }}
{!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono') }}</label>
    <div>
        {{ Form::text('telefono', $cita->telefono, ['class' => 'form-control' .
        ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha') }}</label>
    <div>
        {{ Form::text('fecha', $cita->fecha, [
            'class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),
            'placeholder' => 'Selecciona una fecha',
            'id' => 'fecha',   // IMPORTANTE para Litepicker
            'autocomplete' => 'off'
        ]) }}
        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('hora') }}</label>
    <div>
        {{ Form::text('hora', $cita->hora, [
            'class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''),
            'placeholder' => 'Selecciona hora',
            'id' => 'hora_picker',
            'autocomplete' => 'off'
        ]) }}
        {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione hora disponible entre 9:00 y 18:00.</small>
    </div>
   
</div>

</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('asunto') }}</label>
    <div>
        {{ Form::text('asunto', $cita->asunto, ['class' => 'form-control' .
        ($errors->has('asunto') ? ' is-invalid' : ''), 'placeholder' => 'Asunto']) }}
        {!! $errors->first('asunto', '<div class="invalid-feedback">:message</div>') !!}
      
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
 <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Litepicker({
        element: document.getElementById('fecha'),
        format: 'YYYY-MM-DD', // formato compatible con la base de datos
        lang: 'es-ES',
        singleMode: true,
        minDate: new Date(), // opcional: bloquear fechas pasadas
    });
});
</script>


 <!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let horasOcupadas = @json($horas_ocupadas); // ['09:00', '09:15', ...]

    flatpickr("#hora_picker", {
        enableTime: true,
        noCalendar: true,       // solo hora
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 15,    // bloques de 15 min
        minTime: "09:00",
        maxTime: "18:00",
        disable: horasOcupadas  // horas ocupadas
    });
});
</script>


