<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $clave
 * @property $modelo
 * @property $marca
 * @property $stock
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'clave' => 'required|digits:5',
		'modelo' => 'required|string|max:10|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
		'marca' => 'required|string|max:10|regex:/^[A-ZÁÉÍÓÚÑ ]+$/',
		'stock' => 'required|integer|min:0|max:999999999999999',
		'precio' => 'required|numeric|min:0|max:999999.99',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clave','modelo','marca','stock','precio'];



}
