@php
    use app\Controller\UsuarioController;
    use app\Core\Helpers;
@endphp

@extends('dashboard-base')

@section('titulo')
    <h2>Dashboard</h2>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ Helpers::url('/admin/dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>
    <h5 class="mb-3">Seja bem-vindo de volta, {{ UsuarioController::usuario()->nome }}!</h5>

    </div>
@endsection
