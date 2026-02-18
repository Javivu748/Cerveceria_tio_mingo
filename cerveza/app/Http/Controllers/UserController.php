<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;

class UserController extends Controller
{
    /**
     * Mostrar dashboard admin con todos los usuarios
     */
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboardAdmin', compact('users'));
    }

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

        return redirect()->route('admin.usuarios')->with('success', 'Cuenta eliminada correctamente');
    }

    /**
     * Mostrar formulario para editar usuario
     */
    public function editar()
    {
        $user = auth()->user();
        return view('profile.editarPerfil', compact('user'));
    }

    /**
     * Actualizar datos del usuario
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard', $user->id)
                       ->with('success', 'Perfil actualizado correctamente.');
    }

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

