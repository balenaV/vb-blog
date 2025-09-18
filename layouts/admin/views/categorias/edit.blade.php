@extends('dashboard')


@section('titulo')
    Editar Categoria
@endsection
@section('content')
    <form action="{{ app\Core\Helpers::url('admin/categorias/edit/' . $categoria->id) }}" method="POST">
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título exemplo"
                value="{{ $categoria->titulo }}">
        </div>
        <div class="form-group mb-3">
            <label for="texto">Texto</label>
            <textarea class="form-control" id="texto" name="texto" rows="3">{{ $categoria->texto }}</textarea>
        </div>

        <select class="form-select mb-3" name="status">
            <option value="1" @if ($categoria->status == 1) selected @endif>Ativo</option>
            <option value="0" @if ($categoria->status == 0) selected @endif>Inativo</option>
        </select>

        <div class="d-flex justify-content-between">
            <input type="submit" value="Editar" class="btn btn-primary">
            <a href="{{ app\Core\Helpers::url('admin/categorias/index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
