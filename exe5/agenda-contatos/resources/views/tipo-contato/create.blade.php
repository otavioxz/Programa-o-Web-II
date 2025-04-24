@extends('layouts.app')

@section('title', 'Criar Tipo de Contato')

@section('content')
    <h1>Criar Tipo de Contato</h1>

    <form action="{{ route('tipo-contato.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection