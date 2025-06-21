@extends('layouts.app')

@section('title', $book->titulo . ' - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="bg-success rounded d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 120px; height: 150px;">
                        <i class="fas fa-book fa-4x text-white"></i>
                    </div>
                    <h4 class="card-title">{{ $book->titulo }}</h4>
                    <p class="text-muted mb-2">
                        <i class="fas fa-user me-1"></i>
                        <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                            {{ $book->author->nome }}
                        </a>
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-barcode me-1"></i>{{ $book->isbn }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary me-2">
                            <i class="fas fa-tag me-1"></i>{{ $book->genero }}
                        </span>
                        <span class="badge bg-secondary">
                            <i class="fas fa-calendar me-1"></i>{{ $book->ano_publicacao }}
                        </span>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Editar Livro
                        </a>
                        <form method="POST" 
                              action="{{ route('books.destroy', $book) }}" 
                              onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-1"></i>Excluir Livro
                            </button>
                        </form>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Voltar ao Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            @if($book->descricao)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-file-text me-2"></i>Descrição
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $book->descricao }}</p>
                    </div>
                </div>
            @endif
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informações Detalhadas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong><i class="fas fa-book me-2"></i>Título:</strong></td>
                                    <td>{{ $book->titulo }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-user me-2"></i>Autor:</strong></td>
                                    <td>
                                        <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                                            {{ $book->author->nome }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-tag me-2"></i>Gênero:</strong></td>
                                    <td>{{ $book->genero }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong><i class="fas fa-barcode me-2"></i>ISBN:</strong></td>
                                    <td>{{ $book->isbn }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-calendar me-2"></i>Ano de Publicação:</strong></td>
                                    <td>{{ $book->ano_publicacao }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-clock me-2"></i>Cadastrado em:</strong></td>
                                    <td>{{ $book->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>Sobre o Autor
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-user text-white fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ $book->author->nome }}</h6>
                            <p class="text-muted mb-1">
                                <i class="fas fa-envelope me-1"></i>{{ $book->author->email }}
                            </p>
                            @if($book->author->data_nascimento)
                                <small class="text-muted">
                                    <i class="fas fa-birthday-cake me-1"></i>
                                    {{ $book->author->data_nascimento->format('d/m/Y') }}
                                </small>
                            @endif
                        </div>
                    </div>
                    
                    @if($book->author->biografia)
                        <p class="card-text">{{ Str::limit($book->author->biografia, 200) }}</p>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-book me-1"></i>
                            {{ $book->author->books->count() }} {{ $book->author->books->count() == 1 ? 'livro' : 'livros' }} cadastrados
                        </span>
                        <a href="{{ route('authors.show', $book->author) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>Ver Perfil Completo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

