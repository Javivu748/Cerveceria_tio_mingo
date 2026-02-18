<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Muestra la vista para crear una nueva contraseña.
     * Aquí llega el usuario desde el link que le mandaron por email.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', [
            'request' => $request,
        ]);
    }

    /**
     * Procesa el formulario de cambio de contraseña.
     * Valida los datos, intenta resetear la contraseña y maneja los posibles errores.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validamos los datos básicos del formulario
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Intentamos resetear la contraseña usando el broker de Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                // Actualizamos la contraseña del usuario
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Disparamos el evento de password reset por si hay listeners
                event(new PasswordReset($user));
            }
        );

        // Si todo salió bien, mandamos al login con un mensaje de estado.
        // Si hubo algún problema, regresamos al formulario con el error.
        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with('status', __($status));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => __($status),
            ]);
    }
}
