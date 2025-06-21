@extends('layouts.app')

@section('title', $author->nome . ' - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 100px; height: 100px;">
                        <i class="fas fa-user fa-3x text-white"></i>
                    </div>
                    <h3 class="card-title">{{ $author->nome }}</h3>
                    <p class="text-muted">
                        <i class="fas fa-envelope me-1"></i>{{ $author->email }}
                    </p>
                    
                    @if($author->data_nascimento)
                        <p class="text-muted">
                            <i class="fas fa-birthday-cake me-1"></i>
                            {{ $author->data_nascimento->format('d/m/Y') }}
                            ({{ $author->data_nascimento->age }} anos)
                        </p>
                    @endif
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Editar Autor
                        </a>
                        <form method="POST" 
                              action="{{ route('authors.destroy', $author) }}" 
                              onsubmit="return confirm('Tem certeza que deseja excluir este autor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-1"></i>Excluir Autor
                            </button>
                        </form>
                        <a href="{{ route('authors.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Voltar à Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            @if($author->biografia)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-file-text me-2"></i>Biografia
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $author->biografia }}</p>
                    </div>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-book me-2"></i>
                        Livros ({{ $author->books->count() }})
                    </h5>
                    <a href="{{ route('books.create') }}?author_id={{ $author->id }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Adicionar Livro
                    </a>
                </div>
                <div class="card-body">
                    @if($author->books->count() > 0)
                        <div class="row g-3">
                            @foreach($author->books as $book)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                                    {{ $book->titulo }}
                                                </a>
                                            </h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-tag me-1"></i>{{ $book->genero }} | 
                                                    <i class="fas fa-calendar me-1"></i>{{ $book->ano_publicacao }}
                                                </small>
                                            </p>
                                            @if($book->descricao)
                                                <p class="card-text">
                                                    {{ Str::limit($book->descricao, 100) }}
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Nenhum livro cadastrado</h5>
                            <p class="text-muted">Este autor ainda não possui livros cadastrados.</p>
                            <a href="{{ route('books.create') }}?author_id={{ $author->id }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Adicionar Primeiro Livro
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

