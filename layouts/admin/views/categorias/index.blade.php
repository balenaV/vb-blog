@extends('dashboard-base')


@section('titulo')
    <h1 id="tituloPagina" class="fw-bold fs-1">Categorias</h1>
@endsection
@section('content')
    @if (!$categorias)
        <div class="alert alert-warning" role="alert">Nenhuma Categoria foi criada.</strong>
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
                <a href="{{ app\Core\Helpers::url('admin/categorias/create') }}" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Texto</th>
                        <th scope="col" class="text-center">Visitas</th>
                        <th scope="col" class="text-start">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <th scope="row">{{ $categoria->id }}</th>
                            <td>{{ $categoria->titulo }}</td>
                            <td class="">{{ $categoria->texto }}</td>
                            <td class="text-center">
                                {{ $categoria->visitas }}
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
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $categoria->id }}">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </button>
                                        </abbr>
                                    </div>
                                    <div class="me-1">

                                        <abbr title="Status">
                                            <a href="#info{{ $categoria->id }}" data-bs-toggle="offcanvas"
                                                tooltip="tooltip" title="Status">
                                                <i class="fa-solid fa-chart-simple text-primary"></i>
                                            </a>
                                        </abbr>
                                    </div>
                                </div>
                            </td>

                        </tr>

                        {{-- --------- OFF CANVAS STATUS POST ------- --}}
                        <div class="offcanvas offcanvas-start" tabindex="1" id="info{{ $categoria->id }}">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{ $categoria->titulo }} - </h5>
                                <div><span
                                        class="text-white {{ $categoria->status == 1 ? 'bg-success' : 'bg-danger' }}  fw-bold p-1 rounded-2  me-1 ms-1">{{ $categoria->status == 1 ? 'Ativo' : 'Inativo' }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="list-group list-group-flush">
                                    <li class=" list-group-item">
                                        <span class="fw-bold">Cadastrado em:</span>
                                        {{ date('d/m/Y h:i:s', strtotime($categoria->dataCadastro)) }}
                                    </li>
                                    <li class=" list-group-item">
                                        <span class="fw-bold">Atualizado em:</span>
                                        {{ date('d/m/Y h:i:s', strtotime($categoria->alteracaoData)) }}
                                    </li>
                                    <li class=" list-group-item">
                                        <span class="fw-bold">Última visita :</span>
                                        {{ $categoria->visitas > 0 ? $categoria->ultimaVisita : 'Esta categoria não possui visitas.' }}
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
    @include('categorias.delete')
@endsection

@section('scripts')
@endsection
