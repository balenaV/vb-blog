@extends('structure.base')

{{-- @section('title', $titulo) --}}

@section('content')
    <h1>Post {{ $post->id }} - {{ $post->titulo }}</h1>

    <div class="container my-5">
        <div class="card  mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->titulo }}</h5>
                <p class="card-text">{{ $post->texto }}</p>
                <div class="d-flex justify-content-start">
                    <a class="badge text-danger text-decoration-none" href="{{ infinit\Nucleo\Helpers::url('') }}">
                        <- Voltar </a>
                </div>
            </div>
        </div>
    </div>
@endsection
