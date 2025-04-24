<?php

namespace App\Http\Controllers;

use App\Models\TipoContato;
use Illuminate\Http\Request;

class TipoContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposContato = TipoContato::all();
        return view('tipo-contato.index', compact('tiposContato'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo-contato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string'
        ]);

        TipoContato::create($request->all());

        return redirect()->route('tipo-contato.index')
                         ->with('success', 'Tipo de contato criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoContato $tipoContato)
    {
        return view('tipo-contato.show', compact('tipoContato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoContato $tipoContato)
    {
        return view('tipo-contato.edit', compact('tipoContato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoContato $tipoContato)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string'
        ]);

        $tipoContato->update($request->all());

        return redirect()->route('tipo-contato.index')
                         ->with('success', 'Tipo de contato atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoContato $tipoContato)
    {
        $tipoContato->delete();

        return redirect()->route('tipo-contato.index')
                         ->with('success', 'Tipo de contato excluído com sucesso.');
    }
}