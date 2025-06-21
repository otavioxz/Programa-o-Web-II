@extends('layouts.app')

@section('title', 'Editar Autor - Sistema de Biblioteca')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>
                        Editar Autor: {{ $author->nome }}
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('authors.update', $author) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nome *
                                </label>
                                <input type="text" 
                                       class="form-control @error('nome') is-invalid @enderror" 
                                       id="nome" 
                                       name="nome" 
                                       value="{{ old('nome', $author->nome) }}" 
                                       required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email *
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $author->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">
                                <i class="fas fa-birthday-cake me-1"></i>Data de Nascimento
                            </label>
                            <input type="date" 
                                   class="form-control @error('data_nascimento') is-invalid @enderror" 
                                   id="data_nascimento" 
                                   name="data_nascimento" 
                                   value="{{ old('data_nascimento', $author->data_nascimento?->format('Y-m-d')) }}">
                            @error('data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="biografia" class="form-label">
                                <i class="fas fa-file-text me-1"></i>Biografia
                            </label>
                            <textarea class="form-control @error('biografia') is-invalid @enderror" 
                                      id="biografia" 
                                      name="biografia" 
                                      rows="4" 
                                      placeholder="Conte um pouco sobre o autor...">{{ old('biografia', $author->biografia) }}</textarea>
                            @error('biografia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Voltar
                            </a>
                            <div>
                                <a href="{{ route('authors.show', $author) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-1"></i>Visualizar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-1"></i>Atualizar Autor
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

