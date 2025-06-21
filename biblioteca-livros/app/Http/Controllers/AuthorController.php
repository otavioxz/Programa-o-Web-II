<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Author::query();
        
        if ($request->has('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        
        $authors = $query->withCount('books')->paginate(10);
        
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:authors',
            'biografia' => 'nullable|string',
            'data_nascimento' => 'nullable|date'
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')
                        ->with('success', 'Autor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id,
            'biografia' => 'nullable|string',
            'data_nascimento' => 'nullable|date'
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')
                        ->with('success', 'Autor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')
                        ->with('success', 'Autor excluído com sucesso!');
    }
}
