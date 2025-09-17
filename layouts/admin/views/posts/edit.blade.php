@extends('dashboard')


@section('titulo')
    Editar Post
@endsection
@section('content')
    <form action="{{ app\Core\Helpers::url('admin/posts/edit/' . $post->id) }}" method="POST">
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <input type="text" value="{{ $post->titulo }}" class="form-control" id="titulo" name="titulo"
                placeholder="Título exemplo">
        </div>
        <div class="form-group mb-3">
            <label for="texto">Texto</label>
            <textarea class="form-control" id="texto" name="texto" rows="3">{{ $post->texto }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <select class="form-select mb-3" name="categoriaId">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @if ($post->categoriaId == $categoria->id) selected @endif>
                        {{ $categoria->titulo }}</option>
                @endforeach
            </select>
            <select class="form-select mb-3" name="status">
                <option value="1" @if ($post->status == 1) selected @endif>Ativo</option>
                <option value="0" @if ($post->status == 0) selected @endif>Inativo</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <input type="submit" value="Editar" class="btn btn-primary">
            <a href="{{ app\Core\Helpers::url('admin/posts/index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
