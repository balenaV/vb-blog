@extends('dashboard')


@section('titulo')
    Cadastrar Post
@endsection
@section('content')
    <form action="{{ app\Core\Helpers::url('admin/posts/create') }}" method="POST">
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título exemplo">
        </div>
        <div class="form-group mb-3">
            <label for="texto">Texto</label>
            <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
        </div>

        <div class="d-flex gap-2">
            <select class="form-select mb-3" name="categoriaId">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->titulo }}</option>
                @endforeach
            </select>
            <select class="form-select mb-3" name="status">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <input type="submit" value="Cadastrar" class="btn btn-primary">
            <a href="{{ app\Core\Helpers::url('admin/posts/index') }}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
@endsection
