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
            <div class="d-flex justify-content-around gap-2">
                <div class="bg-light p-1 rounded-1 fs-6">
                    <span class="text-dark fw-bolder ms-1 ">usuarios:
                        {{ $total['usuarioComum']['ativo'] + $total['usuarioComum']['inativo'] }} -
                    </span>

                    <span
                        class="text-white bg-primary  fw-bold  rounded-3   ms-1 p-1 fs-6">{{ $total['usuarioComum']['ativo'] }}</span>
                    <span class=" text-white bg-danger  fw-bold p-1 rounded-3  me-1  ">
                        {{ $total['usuarioComum']['inativo'] }}
                    </span>
                </div>
                <div class="bg-light p-1 rounded-1 fs-6">
                    <span class="text-dark fw-bolder ms-1 ">criadores:
                        {{ $total['criador']['ativo'] + $total['criador']['inativo'] }} -
                    </span>

                    <span
                        class="text-white bg-primary  fw-bold  rounded-3   ms-1 p-1 fs-6">{{ $total['criador']['ativo'] }}</span>
                    <span class=" text-white bg-danger  fw-bold p-1 rounded-3  me-1  ">
                        {{ $total['criador']['inativo'] }}
                    </span>
                </div>
                <div class="bg-light p-1 rounded-1 fs-6">
                    <span class="text-dark fw-bolder ms-1 ">administradores:
                        {{ $total['administrador']['ativo'] + $total['administrador']['inativo'] }} -
                    </span>

                    <span
                        class="text-white bg-primary  fw-bold  rounded-3   ms-1 p-1 fs-6">{{ $total['administrador']['ativo'] }}</span>
                    <span class=" text-white bg-danger  fw-bold p-1 rounded-3  me-1  ">
                        {{ $total['administrador']['inativo'] }}
                    </span>
                </div>
            </div>
            <div class="card-header bg-white border-0 ">
                <a href="{{ app\Core\Helpers::url('admin/usuarios/create') }}" class="btn btn-primary">Cadastrar</a>
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

@section('modal-delete')
    @include('usuarios.delete')
@endsection
