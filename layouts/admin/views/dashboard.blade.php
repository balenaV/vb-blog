@php
    use app\Controller\UsuarioController;
    use app\Core\Helpers;
@endphp

@extends('dashboard-base')

@section('content')
    <h5 class="mb-3">Seja bem-vindo de volta, {{ UsuarioController::usuario()->nome }}!</h5>
@endsection


@section('second-content')
    <div class="row">


        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-secondary fw-bold mb-0">Posts</h5>
                        <i class="fa-solid fa-file-pen fs-3"></i>
                    </div>

                    <h1 class="display-4 fw-bold mb-3">{{ $posts['total'] }}</h1>

                    <div>
                        <span class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2">
                            {{ $posts['ativo'] }} Ativo
                        </span>
                        <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold">
                            {{ $posts['inativo'] }} Inativo
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-secondary fw-bold mb-0">Usuários</h5>
                        <i class="fas fa-users fs-3"></i>
                    </div>

                    <h1 class="display-4 fw-bold mb-3">{{ $usuarios['total'] }}</h1>

                    <div>
                        <span class="badge rounded-pill bg-success-subtle text-success-emphasis fw-semibold me-2">
                            {{ $usuarios['ativo'] }} Ativo
                        </span>
                        <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis fw-semibold">
                            {{ $usuarios['inativo'] }} Inativo
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
