<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImcController extends Controller
{
    public function index()
    {
        return view('imc.index');
    }

    public function calcular(Request $request)
    {
        $peso = $request->input('peso');
        $altura = $request->input('altura');
        $imc = $peso / ($altura * $altura);

        return view('imc.index', compact('imc'));
    }
}
