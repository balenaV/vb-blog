;@php
    use app\Controller\UsuarioController;
    use app\Core\Helpers;
@endphp

@extends('dashboard-base')

@section('content')
    <h5 class="mb-3">Seja bem-vindo de volta, {{ $usuarioSessao->nome }}!</h5>
@endsection


@section('second-content')
    <div class="container-fluid p-4">
        <div class="row g-4">

            <div class="col-lg-5">
                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title text-secondary fw-bold mb-0">Posts</h5>
                                    <i class="fa-solid fa-file-pen fs-4"></i>
                                </div>
                                <h1 class="display-4 fw-bold mb-3">{{ $posts['total'] }}</h1>
                                <div>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2 mb-2">
                                        {{ $posts['ativo'] }} Ativo
                                    </span>
                                    <span
                                        class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold  mb-2">
                                        {{ $posts['inativo'] }} Inativo
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title text-secondary fw-bold mb-0">Categorias</h5>
                                    <i class="fas fa-list fs-4"></i>
                                </div>
                                <h1 class="display-4 fw-bold mb-3">{{ $categorias['total'] }}</h1>
                                <div>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2   mb-2">
                                        {{ $categorias['ativo'] }} Ativo
                                    </span>
                                    <span
                                        class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold    mb-2">
                                        {{ $categorias['inativo'] }} Inativo
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title text-secondary fw-bold mb-0">Usuários</h5>
                                    <i class="fas fa-users fs-3"></i>
                                </div>
                                <h1 class="display-4 fw-bold mb-3">{{ $usuarios['total'] }}</h1>
                                <div>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2     mb-2">
                                        {{ $usuarios['ativo'] }} Ativo
                                    </span>
                                    <span
                                        class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold      mb-2">
                                        {{ $usuarios['inativo'] }} Inativo
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title text-secondary fw-bold mb-0">Admins</h5>
                                    <i class="fa-solid fa-screwdriver-wrench fs-3"></i>
                                </div>
                                <h1 class="display-4 fw-bold mb-3">{{ $admins['total'] }}</h1>
                                <div>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2       mb-2 ">
                                        {{ $admins['ativo'] }} Ativo
                                    </span>
                                    <span
                                        class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold        mb-2">
                                        {{ $admins['inativo'] }} Inativo
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-lg-7 mb-4 ">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        Últimos Posts
                        <a href="{{ Helpers::url('admin/posts/create') }}" class="btn btn-sm btn-outline-danger"><i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Texto</th>
                                        <th scope="col" class="text-start">Status</th>
                                        <th scope="col" class="text-start">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimosPosts as $post)
                                        <tr>
                                            <th scope="row">{{ $post->id }}</th>
                                            <td>{{ $post->titulo }}</td>
                                            <td class="">{{ $post->texto }}</td>
                                            <td>
                                                <i
                                                    class="{{ $post->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }}"></i>
                                            </td>

                                            <td>
                                                <div class="d-flex">

                                                    <div class="me-3">
                                                        <abbr title="Editar" class="ms-auto">
                                                            <a
                                                                href="{{ app\Core\Helpers::url('admin/posts/edit/' . $post->id) }}"><i
                                                                    class=" fa-solid fa-pencil text-warning"></i></a>
                                                        </abbr>
                                                    </div>
                                                    <div class="me-3">

                                                        <abbr title="Excluir">
                                                            <button type="button" class="btn btn-link p-0 delete-btn"
                                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                data-id="{{ $post->id }}">
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
                    </div>
                </div>

            </div>

        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        Últimas Categorias
                        <a href="{{ Helpers::url('admin/categorias/create') }}" class="btn btn-sm btn-outline-danger"><i
                                class="fa-solid fa-plus"></i></a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Título</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-start">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimasCategorias as $categoria)
                                        <tr>
                                            <th scope="row">{{ $categoria->id }}</th>
                                            <td>{{ $categoria->titulo }}</td>
                                            <td class="text-center">
                                                <i
                                                    class="{{ $categoria->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }}  "></i>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <abbr title="Editar">
                                                            <a
                                                                href="{{ app\Core\Helpers::url('admin/categorias/edit/' . $categoria->id) }}"><i
                                                                    class=" fa-solid fa-pencil text-warning"></i></a>
                                                        </abbr>
                                                    </div>
                                                    <div class="me-3">
                                                        <abbr title="Excluir">
                                                            <button type="button" class="btn btn-link p-0 delete-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmDeleteModal"
                                                                data-id="{{ $categoria->id }}">
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
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        Últimos logins

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Úsuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimosLogins as $login)
                                        @php
                                            $timestamp = strtotime($login->ultimoLogin);
                                            $tipousuario = $login->level;
                                            $icon = '';

                                            switch ($tipousuario) {
                                                case 1:
                                                    $icon = 'fa-solid fa-user';
                                                    break;
                                                case 2:
                                                    $icon = 'fa-solid fa-camera-retro';
                                                    break;
                                                case 3:
                                                    $icon = 'fa-solid fa-screwdriver-wrench';
                                                    break;
                                            }
                                        @endphp
                                        <tr>
                                            <th scope="row">
                                                <i class=" {{ $icon }} justify-content-center"></i>
                                            </th>
                                            <td><span class="fw-bold ">{{ $login->nome }}</span> <br><span
                                                    class="fs-6 fw-light">
                                                    {{ date('d/m/Y', $timestamp) }} às
                                                    {{ date('H:i', $timestamp) }}
                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
