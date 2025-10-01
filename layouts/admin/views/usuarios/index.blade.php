@extends('dashboard-base')


@section('titulo')
    <h1 class="fw-bold fs-1" id="tituloPagina">Usuários</h1>
@endsection
@section('content')
    @if (!$usuarios)
        <div class="alert alert-warning" role="alert">Nenhum usuário foi criado.</strong>
        </div>
    @else
        {{ app\Core\Helpers::flash() }}

        <div class="d-flex justify-content-between text-secondary align-items-center  fs-6 ">
            <div>
                Total: <span class="fw-bolder ms-1 me-1">{{ $total['todos'] }}</span> -
                <span class="text-white bg-success  fw-bold p-1 rounded-2  me-1 ms-1">{{ $total['ativo'] }} Ativos</span>


                <span class=" text-white bg-danger  fw-bold p-1 rounded-2  me-1 ms-1">
                    {{ $total['inativo'] }} Inativos
                </span>
            </div>
            <div class="card-header bg-white border-0 ">
                <a href="{{ app\Core\Helpers::url('admin/categorias/create') }}" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Permissão</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-start">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <th scope="row">{{ $usuario->id }}</th>
                            <td>{{ $usuario->nome }}</td>
                            <td class="">{{ $usuario->email }}</td>
                            <td class="text-start">
                                @php
                                    switch ($usuario->level) {
                                        case '1':
                                            echo 'Usuário';
                                            break;
                                        case '2':
                                            echo 'Criador';
                                            break;
                                        case '3':
                                            echo 'Administrador';
                                            break;
                                    }
                                @endphp
                            </td>
                            <td class="text-center">
                                <i
                                    class="{{ $usuario->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }}  "></i>
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <abbr title="Editar">
                                            <a href="{{ app\Core\Helpers::url('admin/usuarios/edit/' . $usuario->id) }}"><i
                                                    class=" fa-solid fa-pencil text-warning"></i></a>
                                        </abbr>
                                    </div>
                                    <div class="me-3">
                                        <abbr title="Excluir">
                                            <button type="button" class="btn btn-link p-0 delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $usuario->id }}">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </button>
                                        </abbr>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <hr>
    @endif
@endsection
