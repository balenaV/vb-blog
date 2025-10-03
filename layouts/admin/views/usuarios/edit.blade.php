@extends('dashboard-base')


@section('titulo')
    Editar Usuário
@endsection
@section('content')
    {{ app\Core\Helpers::flash() }}

    <form action="{{ app\Core\Helpers::url('admin/usuarios/edit/' . $usuario->id) }}" method="POST">
        <div class="d-flex  gap-2">
            <div class="form-group mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                    value="{{ $nome }}">
            </div>
            <div class="form-group mb-3">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome"
                    value="{{ $sobrenome }}">
            </div>

            <div class="justify-items-end form-group mb-3">
                <label for="senha" class="login__label">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="sobrenome" name="email" placeholder="E-mail"
                value="{{ $usuario->email }}">
        </div>



        <div class="d-flex justify-content-between gap-2">
            <select class="form-select mb-3" name="level">
                <option value="1" @if ($usuario->level == 1) selected @endif>Usuário</option>
                <option value="2" @if ($usuario->level == 2) selected @endif>Criador</option>
                <option value="3" @if ($usuario->level == 3) selected @endif>Administrador</option>
            </select>

            <select class="form-select mb-3" name="status">
                <option value="1" @if ($usuario->status == 1) selected @endif>Ativo</option>
                <option value="0" @if ($usuario->status == 0) selected @endif>Inativo</option>
            </select>

        </div>

        <div class="d-flex justify-content-between">
            <input type="submit" value="Editar" class="btn btn-primary">
            <a href="#" onclick="history.back()" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
