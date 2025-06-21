@extends('layouts.app')

@section('title', 'Editar Livro - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-book-edit me-2"></i>
                        Editar Livro: {{ $book->titulo }}
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('books.update', $book) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="titulo" class="form-label">
                                    <i class="fas fa-book me-1"></i>Título *
                                </label>
                                <input type="text" 
                                       class="form-control @error('titulo') is-invalid @enderror" 
                                       id="titulo" 
                                       name="titulo" 
                                       value="{{ old('titulo', $book->titulo) }}" 
                                       required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="isbn" class="form-label">
                                    <i class="fas fa-barcode me-1"></i>ISBN *
                                </label>
                                <input type="text" 
                                       class="form-control @error('isbn') is-invalid @enderror" 
                                       id="isbn" 
                                       name="isbn" 
                                       value="{{ old('isbn', $book->isbn) }}" 
                                       required>
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author_id" class="form-label">
                                    <i class="fas fa-user me-1"></i>Autor *
                                </label>
                                <select class="form-select @error('author_id') is-invalid @enderror" 
                                        id="author_id" 
                                        name="author_id" 
                                        required>
                                    <option value="">Selecione um autor</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" 
                                                {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                            {{ $author->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <a href="{{ route('authors.create') }}" class="text-decoration-none">
                                        <i class="fas fa-plus me-1"></i>Cadastrar novo autor
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="genero" class="form-label">
                                    <i class="fas fa-tag me-1"></i>Gênero *
                                </label>
                                <input type="text" 
                                       class="form-control @error('genero') is-invalid @enderror" 
                                       id="genero" 
                                       name="genero" 
                                       value="{{ old('genero', $book->genero) }}" 
                                       list="generos"
                                       required>
                                <datalist id="generos">
                                    <option value="Ficção">
                                    <option value="Romance">
                                    <option value="Mistério">
                                    <option value="Fantasia">
                                    <option value="Ficção Científica">
                                    <option value="Biografia">
                                    <option value="História">
                                    <option value="Autoajuda">
                                    <option value="Técnico">
                                    <option value="Infantil">
                                </datalist>
                                @error('genero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="ano_publicacao" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Ano de Publicação *
                                </label>
                                <input type="number" 
                                       class="form-control @error('ano_publicacao') is-invalid @enderror" 
                                       id="ano_publicacao" 
                                       name="ano_publicacao" 
                                       value="{{ old('ano_publicacao', $book->ano_publicacao) }}" 
                                       min="1000" 
                                       max="{{ date('Y') }}"
                                       required>
                                @error('ano_publicacao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descricao" class="form-label">
                                <i class="fas fa-file-text me-1"></i>Descrição
                            </label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                      id="descricao" 
                                      name="descricao" 
                                      rows="4" 
                                      placeholder="Descreva o livro, sua trama ou conteúdo...">{{ old('descricao', $book->descricao) }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Voltar
                            </a>
                            <div>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-1"></i>Visualizar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-1"></i>Atualizar Livro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

