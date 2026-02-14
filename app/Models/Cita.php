<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cita
 *
 * @property $id
 * @property $nombre
 * @property $correo
 * @property $telefono
 * @property $fecha
 * @property $hora
 * @property $asunto
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cita extends Model
{
    
    static $rules = [
		'nombre' => ['required|string|max:40|regex:/^[A-ZÁÉÍÓÚÑ ]+$/'],
		'correo' => ['required', 'email:rfc,dns'],
		'telefono' => ['required','digits:10'],
		'fecha' => 'required',
		'hora' => 'required',
		'asunto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','correo','telefono','fecha','hora','asunto'];



}
