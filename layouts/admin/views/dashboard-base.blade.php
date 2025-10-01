@extends('structure.base')

@section('body')
    @include('structure.menu')
    <div class="conteudo">
        @include('structure.topo')
        <main>
            <div class="card border-0 mb-4 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h2 class="card-title">
                        @yield('titulo')


                    </h2>
                </div>
                <div class="card-body">
                    @yield('content')

                </div>
            </div>
            @yield('second-content')
        </main>
        @include('structure.rodape')
    </div>
    @include('categorias.delete')
    @yield('scripts')
@endsection
