@extends('layouts.app')

@section('title', 'Tipos de Contato')

@section('content')
    <h1>Tipos de Contato</h1>
    <a href="{{ route('tipo-contato.create') }}" class="btn btn-primary mb-3">Novo Tipo</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiposContato as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->nome }}</td>
                <td>{{ $tipo->descricao }}</td>
                <td>
                    <a href="{{ route('tipo-contato.show', $tipo->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('tipo-contato.edit', $tipo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tipo-contato.destroy', $tipo->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection