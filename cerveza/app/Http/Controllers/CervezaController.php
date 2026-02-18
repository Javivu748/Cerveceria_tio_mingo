<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerveza;
use App\Models\Estilo;
use App\Models\Cerveceria;
use App\Services\ExchangeService;

class CervezaController extends Controller
{
    // ─────────────────────────────────────────
    //  PÚBLICO
    // ─────────────────────────────────────────

    public function cervezas()
    {
        $cervezas = Cerveza::with(['estilo', 'cerveceria'])->get();
        return view('cerveza.cervezas', compact('cervezas'));
    }

    public function index()
    {
        $cervezas = Cerveza::with(['estilo', 'cerveceria'])->paginate(6);
        return view('cerveza.cervezas', compact('cervezas'));
    }

    public function show($id)
    {
        $cerveza = Cerveza::with(['estilo'])->findOrFail($id);
        $availableCurrencies = ['USD', 'GBP', 'JPY', 'MXN', 'CAD', 'AUD', 'CHF', 'CNY'];
        return view('cerveza.infoCerveza', compact('cerveza', 'availableCurrencies'));
    }

    // ─────────────────────────────────────────
    //  ADMIN — CRUD
    // ─────────────────────────────────────────

    /**
     * Listado paginado para el panel de admin
     */
    public function adminIndex()
    {
        $cervezas = Cerveza::with(['estilo', 'cerveceria'])->paginate(10);
        return view('admin.cervezas.index', compact('cervezas'));
    }

    /**
     * Formulario para crear una nueva cerveza
     */
    public function create()
    {
        $estilos     = Estilo::orderBy('nombre')->get();
        $cervecerias = Cerveceria::orderBy('nombre')->get();
        return view('admin.cervezas.create', compact('estilos', 'cervecerias'));
    }

    /**
     * Guardar nueva cerveza en base de datos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'precio_eur'    => 'required|numeric|min:0',
            'formato'       => 'required|in:Lata,Botella',
            'capacidad'     => 'required|integer|min:1',
            'estilo_id'     => 'required|exists:estilos,id',
            'cerveceria_id' => 'required|exists:cervecerias,id',
            'imagen_url'    => 'nullable|url|max:500',
        ]);

        Cerveza::create($validated);

        return redirect()
            ->route('admin.cervezas')
            ->with('success', "Cerveza \"{$validated['name']}\" creada correctamente.");
    }

    /**
     * Formulario para editar una cerveza existente
     */
    public function edit($id)
    {
        $cerveza     = Cerveza::findOrFail($id);
        $estilos     = Estilo::orderBy('nombre')->get();
        $cervecerias = Cerveceria::orderBy('nombre')->get();
        return view('admin.cervezas.edit', compact('cerveza', 'estilos', 'cervecerias'));
    }

    /**
     * Actualizar cerveza en base de datos
     */
    public function update(Request $request, $id)
    {
        $cerveza = Cerveza::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'precio_eur'    => 'required|numeric|min:0',
            'formato'       => 'required|in:Lata,Botella',
            'capacidad'     => 'required|integer|min:1',
            'estilo_id'     => 'required|exists:estilos,id',
            'cerveceria_id' => 'required|exists:cervecerias,id',
            'imagen_url'    => 'nullable|url|max:500',
        ]);

        $cerveza->update($validated);

        return redirect()
            ->route('admin.cervezas')
            ->with('success', "Cerveza \"{$cerveza->name}\" actualizada correctamente.");
    }

    /**
     * Eliminar cerveza de la base de datos
     */
    public function destroy($id)
    {
        $cerveza = Cerveza::findOrFail($id);
        $nombre  = $cerveza->name;
        $cerveza->delete();

        return redirect()
            ->route('admin.cervezas')
            ->with('success', "Cerveza \"{$nombre}\" eliminada correctamente.");
    }
}