<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViagemController extends Controller
{
    public function index()
    {
        return view('viagem.index');
    }

    public function calcular(Request $request)
    {
        $distancia = $request->input('distancia');
        $consumo = $request->input('consumo');
        $preco = $request->input('preco');
        $gasto = ($distancia / $consumo) * $preco;

        return view('viagem.index', compact('gasto'));
    }
}

