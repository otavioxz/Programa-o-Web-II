@extends('layouts.app')

@section('title', 'Livros - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold">
                    <i class="fas fa-book me-2 text-primary"></i>
                    Catálogo de Livros
                </h1>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Novo Livro
                </a>
            </div>

            <!-- Search and Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('books.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       id="search"
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Título ou ISBN...">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="genero" class="form-label">Gênero</label>
                            <select class="form-select" id="genero" name="genero">
                                <option value="">Todos os gêneros</option>
                                @foreach($generos as $genero)
                                    <option value="{{ $genero }}" 
                                            {{ request('genero') == $genero ? 'selected' : '' }}>
                                        {{ $genero }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="author_id" class="form-label">Autor</label>
                            <select class="form-select" id="author_id" name="author_id">
                                <option value="">Todos os autores</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" 
                                            {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-filter me-1"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($books->count() > 0)
                <div class="row g-4">
                    @foreach($books as $book)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="bg-success rounded d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 60px;">
                                            <i class="fas fa-book text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-1">{{ $book->titulo }}</h5>
                                            <p class="text-muted mb-1">
                                                <i class="fas fa-user me-1"></i>
                                                <a href="{{ route('authors.show', $book->author) }}" 
                                                   class="text-decoration-none">
                                                    {{ $book->author->nome }}
                                                </a>
                                            </p>
                                            <small class="text-muted">
                                                <i class="fas fa-barcode me-1"></i>{{ $book->isbn }}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="badge bg-primary me-2">
                                            <i class="fas fa-tag me-1"></i>{{ $book->genero }}
                                        </span>
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-calendar me-1"></i>{{ $book->ano_publicacao }}
                                        </span>
                                    </div>
                                    
                                    @if($book->descricao)
                                        <p class="card-text">
                                            {{ Str::limit($book->descricao, 120) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('books.show', $book) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                        <a href="{{ route('books.edit', $book) }}" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <form method="POST" 
                                              action="{{ route('books.destroy', $book) }}" 
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash me-1"></i>Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-book fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">Nenhum livro encontrado</h3>
                    <p class="text-muted">
                        @if(request()->hasAny(['search', 'genero', 'author_id']))
                            Não encontramos livros com os filtros aplicados.
                        @else
                            Comece adicionando seu primeiro livro.
                        @endif
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        @if(request()->hasAny(['search', 'genero', 'author_id']))
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Limpar Filtros
                            </a>
                        @endif
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Adicionar Primeiro Livro
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

