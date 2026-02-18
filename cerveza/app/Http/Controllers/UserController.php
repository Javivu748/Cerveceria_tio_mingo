<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;

class UserController extends Controller
{
    /**
     * Mostrar el dashboard del administrador con todos los usuarios.
     */
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboardAdmin', compact('users'));
    }
    public function buscarUser(Request $request)
    {
        $users = User::where('nombre', 'like', "%{$request->search}%")->get();
        return view('admin.dashboardAdmin', compact('users'));
    }

    /**
     * Mostrar el perfil de un usuario específico y sus pedidos.
     */
    public function userProfile($id)
    {
        $user = User::findOrFail($id);
        $pedidos = Pedido::where('user_id', $id)
                         ->orderBy('fecha', 'desc')
                         ->get();

        return view('admin.pedidoUser', compact('user', 'pedidos'));
    }

    public function eliminar($id){

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.usuarios')
                         ->with('success', 'Cuenta eliminada correctamente.');
    }

    /**
     * Mostrar el formulario para editar el perfil del usuario autenticado.
     */
    public function editar()
    {
        $user = auth()->user();
        return view('profile.editarPerfil', compact('user'));
    }

    /**
     * Actualizar los datos personales del usuario autenticado.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'nombre.required'   => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard', $user->id)
                       ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Actualizar la ubicación del usuario (latitud, longitud y dirección opcional).
     */
    public function updateLocation(Request $request)
    {
        $user = auth()->user();

    $validated = $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'address' => 'nullable|string|max:500',
    ]);

        $user->update($validated);

    return back()->with('success', 'Ubicación actualizada correctamente.');
}

}
