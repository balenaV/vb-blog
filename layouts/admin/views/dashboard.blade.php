@extends('structure.base')

@section('body')
    @include('structure.menu')
    <div class="conteudo">
        @include('structure.topo')
        <main>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title">
                        @yield('titulo')
                    </h5>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('structure.rodape')
    </div>
    @include('categorias.delete')
    @yield('scripts')
@endsection
