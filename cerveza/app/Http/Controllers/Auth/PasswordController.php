<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Actualiza la contraseña del usuario que está logueado.
     * 
     * Se espera que el usuario ingrese su contraseña actual
     * y la nueva contraseña (con confirmación).
     */
    public function update(Request $request): RedirectResponse
    {
        // Validamos los datos con un "bag" específico para errores de password
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();

        // Guardamos la nueva contraseña en la base de datos
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Volvemos a la misma página con un mensaje de éxito
        return back()->with('status', 'password-updated');
    }
}
