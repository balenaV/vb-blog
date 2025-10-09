@extends('dashboard-base')


@section('titulo')
    <h1 id="tituloPagina" class="fw-bold fs-1">Posts</h1>
@endsection
@section('content')
    @if (!$posts)
        <div class="alert alert-warning" role="alert">Você ainda não fez nenhum Post.</strong>
        </div>
    @else
        {{ app\Core\Helpers::flash() }}
        <div class="d-flex justify-content-between text-secondary align-items-center  fs-6 ">
            <div>
                Total: <span class="fw-bolder ms-1 me-1">{{ $total['todos'] }}</span> -
                <span class="text-white bg-success  fw-bold p-1 rounded-2  me-1 ms-1">{{ $total['ativo'] }} Ativos</span>


                <span class=" text-white bg-danger  fw-bold p-1 rounded-2  me-1 ms-1">
                    {{ $total['inativo'] }} Inativos
                </span>
            </div>
            <div class="card-header bg-white border-0 ">
                <a href="{{ app\Core\Helpers::url('admin/posts/create') }}" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Texto</th>
                        <th scope="col" class="text-start">Status</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->titulo }}</td>
                            <td class="">{{ $post->texto }}</td>
                            <td>
                                <i
                                    class="{{ $post->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }} "></i>
                            </td>

                            <td>
                                <div class="d-flex justify-content-between">

                                    <div class="me-3">
                                        <abbr title="Editar" class="ms-auto">
                                            <a href="{{ app\Core\Helpers::url('admin/posts/edit/' . $post->id) }}"><i
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

                                    <div class="me-3">

                                        <abbr title="Status">
                                            <a href="#info{{ $post->id }}" data-bs-toggle="offcanvas" tooltip="tooltip"
                                                title="Status">
                                                <i class="fa-solid fa-chart-simple text-primary"></i>
                                            </a>
                                        </abbr>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        {{-- --------- OFF CANVAS STATUS POST ------- --}}
                        <div class="offcanvas offcanvas-start" tabindex="1" id="info{{ $post->id }}">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{ $post->titulo }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Cadastrado em: {{ $post->dataCadastro }}
                                    </li>
                                    <li class="list-group-item">
                                        Atualizado em: {{ $post->alteracaoData }}
                                    </li>
                                    <li class="list-group-item">
                                        Última visita : Em breve...
                                    </li>
                                    <li class="list-group-item">
                                        Cadastrado por: {{ $post->usuario()->nome }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
        <hr>
    @endif
@endsection

@section('modal-delete')
    @include('posts.delete')
@endsection
