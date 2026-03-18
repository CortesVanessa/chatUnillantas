@extends('tablar::page')

@section('title')
    Cita
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
                        {{ __('Cita ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCita">
    Agendar Cita
</button>
<!-- Modal -->
<div class="modal fade" id="modalCita" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow">

      {{-- FORMULARIO --}}
      <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Agendar Cita</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">

          <div class="form-group mb-3">
              <label class="form-label">Nombre</label>
              {{ Form::text('nombre', old('nombre'), [
                  'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                  'maxlength' => 40
              ]) }}
              {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
          </div>

          <div class="form-group mb-3">
              <label class="form-label">Correo</label>
              {{ Form::email('correo', old('correo'), [
                  'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : '')
              ]) }}
              {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
          </div>

          <div class="form-group mb-3">
              <label class="form-label">Teléfono</label>
              {{ Form::text('telefono', old('telefono'), [
                  'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : '')
              ]) }}
              {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
          </div>
          <div class="form-group mb-3">
            <label>Servicio</label>
              <select name="servicio_id" class="form-control">
                  @foreach($servicios as $servicio)
                 <option value="{{ $servicio->id }}">
            {{ $servicio->servicio }} - ${{ $servicio->precio }}
        </option>
                 @endforeach
              </select>
          </div>

             <div class="form-group mb-3">
                    <label>Producto</label>
           <select name="producto_id" class="form-control">
              @foreach($productos as $producto)
               <option value="{{ $producto->id }}">
            {{ $producto->marca }} {{ $producto->modelo }}
                </option>
             @endforeach
                </select>
                 </div>


          <div class="form-group mb-3">
              <label class="form-label">Fecha</label>
              {{ Form::text('fecha', old('fecha'), [
                  'class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),
                  'id' => 'fecha',
                  'autocomplete' => 'off'
              ]) }}
              {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
          </div>

          <div class="form-group mb-3">
              <label class="form-label">Hora</label>
              {{ Form::text('hora', old('hora'), [
                  'class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''),
                  'id' => 'hora_picker',
                  'autocomplete' => 'off'
              ]) }}
              {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
          </div>

          <div class="form-group mb-3">
              <label class="form-label">Asunto</label>
              {{ Form::text('asunto', old('asunto'), [
                  'class' => 'form-control' . ($errors->has('asunto') ? ' is-invalid' : '')
              ]) }}
              {!! $errors->first('asunto', '<div class="invalid-feedback">:message</div>') !!}
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="btn btn-primary">
            Guardar Cita
          </button>
        </div>

      </form>
      {{-- FIN FORMULARIO --}}

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
                            <h3 class="card-title">Cita</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            
                        </div>
                        <div class="table-responsive" style="overflow:visible;">
                            <table class="table card-table table-vcenter datatable">
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
                                    
										<th>Nombre</th>
										<th>Correo</th>
										<th>Telefono</th>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Asunto</th>
                                        <th>producto</th>
                                        <th>servicio</th>
                                        <th>status</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($citas as $cita)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select cita"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $cita->nombre }}</td>
											<td>{{ $cita->correo }}</td>
											<td>{{ $cita->telefono }}</td>
											<td>{{ $cita->fecha }}</td>
											<td>{{ $cita->hora }}</td>
											<td>{{ $cita->asunto }}</td>
                                            <td>{{ $cita->producto->modelo ?? ''}}</td>
                                            <td>{{ $cita->servicio->servicio ?? ''}}</td>
                                            <td>{{ $cita->status }}</td>
                                           

                                        <td>
<div class="btn-list flex-nowrap">
    <div class="dropdown">
        <button class="btn dropdown-toggle align-text-top"
                data-bs-toggle="dropdown"
                data-bs-boundary="viewport">
            DETALLES
        </button>
        <div class="dropdown-menu dropdown-menu-end">
<form action="{{ route('citas.procesar',$cita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <button type="submit"
                        onclick="return confirm('¿Deseas procesar la cita?')"
                        class="dropdown-item text-danger">
                    procesar
                </button>
            <form action="{{ route('citas.cancelar',$cita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <button type="submit"
                        onclick="return confirm('¿Deseas cancelar la cita?')"
                        class="dropdown-item text-danger">
                    Cancelar
                </button>

            </form>
            <form action="{{ route('citas.finalizar',$cita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <button type="submit"
                        onclick="return confirm('¿Deseas finalizar la cita?')"
                        class="dropdown-item text-danger">
                    Finalizar
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
                            {!! $citas->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    new Litepicker({
        element: document.getElementById('fecha'),
        format: 'YYYY-MM-DD',
        lang: 'es-ES',
        singleMode: true,
        minDate: new Date(),

        lockDaysFilter: (date) => {
            return date.getDay() === 0; // 0 = Domingo
        }
    });
});
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let horasOcupadas = @json($horas_ocupadas);

    flatpickr("#hora_picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 15,
        minTime: "09:00",
        maxTime: "18:00",
        disable: horasOcupadas
    });
});

@endsection



