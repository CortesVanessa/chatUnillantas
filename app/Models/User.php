<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
static $rules = [
		'name' => 'required|string|max:15|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
		'apellido_paterno' => 'required|string|max:15|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
		'apellido_materno' => 'required|string|max:15|regex:/^[A-ZÁÉÍÓÚÑ ]+$/',
		'email' => 'required|email|max:255|unique:users,email',
		'password' => 'required|numeric|',
    ];

    protected $fillable = [
        'name',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}