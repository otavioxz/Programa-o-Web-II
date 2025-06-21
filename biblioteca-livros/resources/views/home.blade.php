@extends('layouts.app')

@section('title', 'Início - Sistema de Biblioteca')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background-image: url('{{ asset('images/hero-bg.png') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" height="60" class="me-3">
                    Biblioteca Digital
                </h1>
                <p class="lead mb-4">
                    Gerencie sua coleção de livros e autores de forma simples e eficiente. 
                    Organize, pesquise e mantenha controle total sobre seu acervo literário.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('books.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-book me-2"></i>Ver Livros
                    </a>
                    <a href="{{ route('authors.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-users me-2"></i>Ver Autores
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="hero-stats">
                    <div class="stat-item mb-3">
                        <h3 class="text-white">{{ \App\Models\Book::count() }}</h3>
                        <p class="text-light">Livros</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="text-white">{{ \App\Models\Author::count() }}</h3>
                        <p class="text-light">Autores</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Funcionalidades do Sistema</h2>
                <p class="text-muted">Tudo que você precisa para gerenciar sua biblioteca</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Gestão de Autores</h5>
                        <p class="card-text">
                            Cadastre e gerencie informações completas dos autores, 
                            incluindo biografia e dados pessoais.
                        </p>
                        <a href="{{ route('authors.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-1"></i>Gerenciar Autores
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-book fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Catálogo de Livros</h5>
                        <p class="card-text">
                            Organize seu acervo com informações detalhadas sobre cada livro, 
                            incluindo gênero, ISBN e descrição.
                        </p>
                        <a href="{{ route('books.index') }}" class="btn btn-success">
                            <i class="fas fa-arrow-right me-1"></i>Ver Catálogo
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-search fa-3x text-info mb-3"></i>
                        <h5 class="card-title">Busca Avançada</h5>
                        <p class="card-text">
                            Encontre rapidamente livros e autores usando filtros por gênero, 
                            nome ou qualquer palavra-chave.
                        </p>
                        <a href="{{ route('books.index') }}" class="btn btn-info">
                            <i class="fas fa-arrow-right me-1"></i>Pesquisar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="fas fa-book fa-2x text-primary mb-2"></i>
                        <h3 class="fw-bold">{{ \App\Models\Book::count() }}</h3>
                        <p class="text-muted">Livros Cadastrados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x text-success mb-2"></i>
                        <h3 class="fw-bold">{{ \App\Models\Author::count() }}</h3>
                        <p class="text-muted">Autores Registrados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="fas fa-tags fa-2x text-info mb-2"></i>
                        <h3 class="fw-bold">{{ \App\Models\Book::distinct('genero')->count('genero') }}</h3>
                        <p class="text-muted">Gêneros Diferentes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="fas fa-calendar fa-2x text-warning mb-2"></i>
                        <h3 class="fw-bold">{{ date('Y') }}</h3>
                        <p class="text-muted">Sistema Atualizado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

