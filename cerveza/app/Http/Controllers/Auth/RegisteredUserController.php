<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario.
     * Valida los datos, crea el usuario, dispara el evento y lo loguea.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validamos los datos enviados desde el formulario
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase', // aseguramos minúsculas
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'telefono' => ['required', 'string', 'regex:/^[69][0-9]{8}$/'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->letters()
                    ->numbers()
                    ->uncompromised(), // evita contraseñas filtradas
            ],
        ]);

        // Creamos el usuario en la base de datos
        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'password' => Hash::make($validated['password']),
        ]);

        // Disparamos el evento de usuario registrado
        event(new Registered($user));

        // Logueamos al usuario recién creado
        Auth::login($user);

        // Redirigimos al dashboard
        return redirect(route('dashboard', absolute: false));
    }
}
