@extends('dashboard-base')


@section('titulo')
    Novo Usuário
@endsection
@section('content')
    <form action="{{ app\Core\Helpers::url('admin/usuarios/create') }}" method="POST">
        <div class="d-flex  gap-2">

            <div class="form-group mb-3">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>
            <div class="form-group mb-3">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
            </div>

            <div class="justify-items-end form-group mb-3">
                <label for="senha" class="login__label">Senha</label>
                <input type="password" name="senha" id="senha" required placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="sobrenome" name="email" placeholder="E-mail"">
        </div>



        <div class="d-flex justify-content-between gap-2">
            <select class="form-select mb-3" name="level">
                <option value="1">Usuário</option>
                <option value="2">Criador</option>
                <option value="3">Administrador</option>
            </select>

            <select class="form-select mb-3" name="status">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>

        </div>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Enviar" class="btn btn-primary">
            <a href="{{ app\Core\Helpers::url('admin/usuarios/index') }}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
@endsection
