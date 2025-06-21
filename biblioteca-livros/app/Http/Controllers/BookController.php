<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('author');
        
        if ($request->has('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%')
                  ->orWhere('isbn', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('genero') && $request->genero != '') {
            $query->where('genero', $request->genero);
        }
        
        if ($request->has('author_id') && $request->author_id != '') {
            $query->where('author_id', $request->author_id);
        }
        
        $books = $query->paginate(10);
        $authors = Author::all();
        $generos = Book::distinct()->pluck('genero')->filter();
        
        return view('books.index', compact('books', 'authors', 'generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'genero' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
                        ->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load('author');
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'genero' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
                        ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                        ->with('success', 'Livro excluído com sucesso!');
    }
}
