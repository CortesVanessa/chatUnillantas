<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Producto;

/**
 * Class CitaController
 * @package App\Http\Controllers
 */
class CitaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
{
    $citas = Cita::with(['producto','servicio'])->paginate(10);
    $cita = new Cita();

    $servicios = Servicio::all();
    $productos = Producto::all();

    $horas_ocupadas = Cita::where('fecha', date('Y-m-d'))
        ->pluck('hora')
        ->toArray();

    return view('cita.index', compact(
        'citas',
        'cita',
        'servicios',
        'productos',
        'horas_ocupadas'
    ))->with('i', (request()->input('page', 1) - 1) * $citas->perPage());
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cita = new Cita();

     $horas_ocupadas = \App\Models\Cita::where('fecha', date('Y-m-d'))
        ->pluck('hora')
        ->toArray();
 // Obtener servicios y productos
    $servicios = Servicio::all();
    $productos = Producto::all();

       return view('cita.create', compact('cita', 'horas_ocupadas'));

        //return view('cita.create', compact('cita'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
     $request->merge([
        'nombre' => strtoupper($request->nombre)
    ]);

    $request->validate(Cita::$rules);
    // Validación básica
    $request->validate(Cita::$rules);

    // 🔎 Verificar si ya existe una cita con esa fecha y hora
    $existe = Cita::where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->exists();

    if ($existe) {
        return back()->withErrors([
            'hora' => '❌ Este horario ya está ocupado, elige otro.'
        ])->withInput();
    }

    // Crear la cita
    Cita::create($request->all());

    return redirect()->route('citas.index')
        ->with('success', '✅ Cita registrada correctamente');
}


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = Cita::find($id);

        return view('cita.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cita = Cita::find($id);

        return view('cita.edit', compact('cita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cita $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        request()->validate(Cita::$rules);

        $cita->update($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);

    $cita->status = 'cancelado';
    $cita->save();

    return redirect()->route('citas.index')
        ->with('success','cita cancelada correctamente');
    }

      public function finalizar($id)
{
    $cita = Cita::findOrFail($id);

    $cita->status = 'finalizado';
    $cita->save();

    return redirect()->route('citas.index')
        ->with('success','cita finalizada correctamente');
}
 
 public function procesar($id)
{
     $cita = Cita::findOrFail($id);

    $cita->status = 'proceso';
    $cita->save();

    return redirect()->route('citas.index')
        ->with('success','cita en proceso');
}

}
