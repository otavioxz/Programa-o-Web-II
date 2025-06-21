@extends('layouts.app')

@section('title', 'Autores - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold">
                    <i class="fas fa-users me-2 text-primary"></i>
                    Autores
                </h1>
                <a href="{{ route('authors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Novo Autor
                </a>
            </div>

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('authors.index') }}" class="row g-3">
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Buscar por nome ou email...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="fas fa-search me-1"></i>Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($authors->count() > 0)
                <div class="row g-4">
                    @foreach($authors as $author)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <h5 class="card-title mb-1">{{ $author->nome }}</h5>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>{{ $author->email }}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    @if($author->data_nascimento)
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-birthday-cake me-1"></i>
                                            {{ $author->data_nascimento->format('d/m/Y') }}
                                        </p>
                                    @endif
                                    
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-book me-1"></i>
                                        {{ $author->books_count }} {{ $author->books_count == 1 ? 'livro' : 'livros' }}
                                    </p>
                                    
                                    @if($author->biografia)
                                        <p class="card-text">
                                            {{ Str::limit($author->biografia, 100) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('authors.show', $author) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                        <a href="{{ route('authors.edit', $author) }}" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <form method="POST" 
                                              action="{{ route('authors.destroy', $author) }}" 
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este autor?')">
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
                    {{ $authors->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">Nenhum autor encontrado</h3>
                    <p class="text-muted">
                        @if(request('search'))
                            Não encontramos autores com o termo "{{ request('search') }}".
                        @else
                            Comece adicionando seu primeiro autor.
                        @endif
                    </p>
                    <a href="{{ route('authors.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Adicionar Primeiro Autor
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

