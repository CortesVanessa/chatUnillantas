<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validamos antes de guardar
    $request->validate(User::$rules, [
        'email.unique' => 'Este correo ya está registrado, no se puede usar.',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->apellido_paterno = $request->apellido_paterno;
    $user->apellido_materno = $request->apellido_materno;
    $user->email = $request->email;
    $user->password = bcrypt($request->password); // Siempre hashear la contraseña
    $user->save();

    return redirect()->route('users.index')
        ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         $request->validate([
        'name' => 'required|string|max:15|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
        'apellido_paterno' => 'required|string|max:15|regex:/^[A-Z0-9ÁÉÍÓÚÑ ]+$/',
        'apellido_materno' => 'required|string|max:15|regex:/^[A-ZÁÉÍÓÚÑ ]+$/',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|numeric',
    ], [
        'email.unique' => 'Este correo ya está registrado, no se puede usar.',
    ]);

    $user->update([
        'name' => $request->name,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
        'email' => $request->email,
        // Solo actualizamos contraseña si se pasó
        'password' => $request->password ? bcrypt($request->password) : $user->password,
    ]);

    return redirect()->route('users.index')
        ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
