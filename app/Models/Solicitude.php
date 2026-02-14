<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 *
 * @property $id
 * @property $nombre
 * @property $correo
 * @property $telefono
 * @property $marca
 * @property $modelo
 * @property $medida
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Solicitude extends Model
{
    
    static $rules = [
		'nombre' => ['required', 'regex:/^[A-ZÁÉÍÓÚÑ ]+$/'],
		'correo' => ['required', 'email:rfc,dns'],
		'telefono' => ['required','digits:10'],
		'marca' =>  'required|in:MICHELIN,BFGOODRICH,UNIROYAL,BRIDGESTONE',
		'modelo' => 'required|string|max:15',
		'medida' => ['required', 'regex:/^\d{3}\/\d{2}\s?R\d{2}$/'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','correo','telefono','marca','modelo','medida'];



}
