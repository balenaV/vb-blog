@extends('dashboard')


@section('titulo')
    Cadastrar Post
@endsection
@section('content')
    <form action="{{ app\Core\Helpers::url('admin/posts/create') }}" method="POST">
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <input type="email" class="form-control" id="titulo" name="titulo" placeholder="Título exemplo">
        </div>
        <div class="form-group mb-3">
            <label for="texto">Texto</label>
            <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
        </div>

        <select class="form-select mb-3" name="status">
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>

        <input type="submit" value="Cadstrar" class="btn btn-primary">
    </form>
@endsection
