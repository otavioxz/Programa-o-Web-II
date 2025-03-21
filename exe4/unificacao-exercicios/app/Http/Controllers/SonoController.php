<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SonoController extends Controller
{
    public function index()
    {
        return view('sono.index');
    }

    public function avaliar(Request $request)
    {
        $horas = $request->input('horas');
        $avaliacao = $horas >= 7 ? 'Bom Sono' : 'Sono Insuficiente';

        return view('sono.index', compact('avaliacao'));
    }
}
