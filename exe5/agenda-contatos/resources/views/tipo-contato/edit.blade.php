@extends('layouts.app')

@section('title', 'Editar Tipo de Contato')

@section('content')
    <h1>Editar Tipo de Contato</h1>

    <form action="{{ route('tipo-contato.update', $tipoContato->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $tipoContato->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $tipoContato->descricao }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection