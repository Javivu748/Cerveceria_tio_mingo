<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CervezaController extends Controller
{
    public function cervezas()
{
    $cervezas = \App\Models\Cerveza::with('formatos')->get();
    return view('cervezas', compact('cervezas'));
}

}
