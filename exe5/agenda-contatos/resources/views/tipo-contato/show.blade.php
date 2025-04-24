@extends('layouts.app')

@section('title', 'Detalhes do Tipo de Contato')

@section('content')
    <h1>Detalhes do Tipo de Contato</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $tipoContato->nome }}</h5>
            <p class="card-text">{{ $tipoContato->descricao }}</p>
            <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection