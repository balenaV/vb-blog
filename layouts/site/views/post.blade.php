@extends('structure.base')

{{-- @section('title', $titulo) --}}

@section('content')
    <h1> {{ $post->titulo }}</h1>

    <div class="container my-5">
        <div class="card  mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->titulo }}</h5>
                <div class="d-flex justify-content-between fs-6 text-secondary my-2">
                    <div>Escrito por <span class="fw-bold">{{ $post->usuario()->nome }}</span> no dia
                        {{ date('d/m/Y', strtotime($post->dataCadastro)) }} às
                        {{ date('H:i', strtotime($post->dataCadastro)) }}</div>

                </div>
                <p class="card-text fs-5">{{ $post->texto }}</p>
                <div class="d-flex justify-content-start">
                    <a class="badge text-danger text-decoration-none" href="{{ app\Core\Helpers::url('') }}">
                        <- Voltar </a>
                </div>
            </div>
        </div>
    </div>
@endsection
