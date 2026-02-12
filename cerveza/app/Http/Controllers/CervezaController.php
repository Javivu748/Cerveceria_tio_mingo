<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerveza;

class CervezaController extends Controller
{
    public function cervezas()
{
    $cervezas = \App\Models\Cerveza::with('formatos')->get();
    return view('cervezas', compact('cervezas'));
}
public function index()
{
    $cervezas = Cerveza::with(['estilo', 'cerveceria'])
                       ->paginate(6);

    return view('cervezas', compact('cervezas'));
}
}
