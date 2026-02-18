<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición del perfil del usuario.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Actualizar la información del perfil del usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Rellenamos el modelo con los datos validados
        $user->fill($request->validated());

        // Si se cambió el email, desmarcamos la verificación
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Guardamos los cambios
        $user->save();

        return Redirect::route('profile.edit')
                       ->with('status', 'profile-updated');
    }

    /**
     * Eliminar la cuenta del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validamos la contraseña antes de eliminar
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Cerramos sesión
        Auth::logout();

        // Eliminamos el usuario
        $user->delete();

        // Limpiamos la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigimos al home
        return Redirect::to('/');
    }
}
