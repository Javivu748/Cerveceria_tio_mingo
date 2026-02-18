<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CerveceriaController extends Controller
{
    /**
     * Muestra un listado de cervezas o cervecerías.
     * Aquí normalmente haríamos una consulta a la base de datos
     * y pasaríamos los datos a una vista.
     */
    public function index()
    {
        // TODO: obtener todas las cervezas y enviarlas a la vista
    }

    /**
     * Muestra el formulario para agregar una nueva cerveza.
     */
    public function create()
    {
        // TODO: retornar la vista con el formulario de creación
    }

    /**
     * Guarda una nueva cerveza en la base de datos.
     */
    public function store(Request $request)
    {
        // TODO: validar datos, crear el registro y redirigir
    }

    /**
     * Muestra los detalles de una cerveza específica.
     */
    public function show(string $id)
    {
        // TODO: obtener la cerveza por ID y mostrarla en una vista
    }

    /**
     * Muestra el formulario para editar una cerveza existente.
     */
    public function edit(string $id)
    {
        // TODO: obtener la cerveza y pasarla al formulario de edición
    }

    /**
     * Actualiza los datos de una cerveza existente.
     */
    public function update(Request $request, string $id)
    {
        // TODO: validar datos, actualizar el registro y redirigir
    }

    /**
     * Elimina una cerveza de la base de datos.
     */
    public function destroy(string $id)
    {
        // TODO: eliminar la cerveza por ID y redirigir con mensaje
    }
}
