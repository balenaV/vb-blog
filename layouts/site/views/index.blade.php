@extends('structure.base')

@section('content')
    <h1 class="mb-4">Lista de Posts</h1>

    <div class="container my-5">
        <div class="row g-4 ">
            {{-- SIDEBAR (CATEGORIAS) --}}
            <aside class="col-lg-3 col-xl-4 order-1 order-lg-2">
                <div class="position-sticky" style="top: 24px;">
                    @include('structure.sidebar')
                </div>
            </aside>

            {{-- COLUNA PRINCIPAL (POSTS) --}}
            <main class="col-lg-9 col-xl-8 order-2 order-lg-1">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($posts as $post)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">{{ $post->titulo }}</h5>
                                    <p class="card-text mb-3">
                                        {{ app\Core\Helpers::resumirTexto($post->texto, 150) }}
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <a class="badge link-danger link-hover-warning text-decoration-none"
                                            href="{{ app\Core\Helpers::url('post/' . $post->id) }}">
                                            Ver post ->
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
@endsection
