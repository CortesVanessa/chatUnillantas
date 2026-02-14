<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sucursale
 *
 * @property $id
 * @property $nombre_sucursal
 * @property $direccion
 * @property $telefono
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sucursale extends Model
{
    
    static $rules = [
		'nombre_sucursal' => 'required|string|max:100|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
		'direccion' => 'required|string|unique:sucursales,direccion',
		'telefono' =>  ['required','digits:10'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_sucursal','direccion','telefono'];



}
