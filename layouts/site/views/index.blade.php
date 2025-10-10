@extends('structure.base')

@section('content')
    <div class="container my-5">
        <div class="row g-4 ">
            {{-- SIDEBAR (CATEGORIAS) --}}
            <aside class="col-lg-3 col-xl-3  order-1 order-lg-2">
                <div class="position-sticky" style="top: 24px;">
                    @include('structure.sidebar')
                </div>
            </aside>


            {{-- COLUNA PRINCIPAL (POSTS) --}}
            <main class="col-lg-9 col-xl-9 order-2 order-lg-1">
                {{ app\Core\Helpers::flash() }}
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($posts as $post)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">{{ $post->titulo }}</h5>
                                    <div class="d-flex justify-content-between fs-6 text-secondary my-2">
                                        <div>{{ $post->categoria()->titulo }}</div>
                                        <div>{{ date('d/m/Y', strtotime($post->dataCadastro)) }}</div>
                                    </div>
                                    <p class="card-text mb-3">
                                        {{ app\Core\Helpers::resumirTexto($post->texto, 150) }}
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <a class="badge link-danger link-hover-warning text-decoration-none"
                                            href="{{ app\Core\Helpers::url('post/' . $post->slug) }}">
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
