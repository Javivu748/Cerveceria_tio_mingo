<?php

namespace App\Http\Controllers;

use App\Models\Estilo;
use Illuminate\Http\Request;

class EstiloController extends Controller
{
    /**
     * Muestra un listado de todos los estilos de cerveza.
     * Normalmente se usaría en el panel de administración o para filtros en el front.
     */
    public function index()
    {
        // TODO: obtener todos los estilos y enviarlos a una vista
    }

    /**
     * Muestra el formulario para crear un nuevo estilo.
     */
    public function create()
    {
        // TODO: retornar la vista con el formulario de creación
    }

    /**
     * Guarda un nuevo estilo en la base de datos.
     */
    public function store(Request $request)
    {
        // TODO: validar datos, crear el registro y redirigir
    }

    /**
     * Muestra la información de un estilo específico.
     */
    public function show(Estilo $estilo)
    {
        // TODO: retornar la vista con los detalles del estilo
    }

    /**
     * Muestra el formulario para editar un estilo existente.
     */
    public function edit(Estilo $estilo)
    {
        // TODO: retornar la vista con el formulario de edición
    }

    /**
     * Actualiza un estilo en la base de datos.
     */
    public function update(Request $request, Estilo $estilo)
    {
        // TODO: validar datos, actualizar el registro y redirigir
    }

    /**
     * Elimina un estilo de la base de datos.
     */
    public function destroy(Estilo $estilo)
    {
        // TODO: eliminar el registro y redirigir con mensaje de éxito
    }
}
