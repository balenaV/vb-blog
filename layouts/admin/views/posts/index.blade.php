@extends('dashboard')


@section('titulo')
    Meus Posts
@endsection
@section('content')
    @if (!$posts)
        <div class="alert alert-warning" role="alert">Você ainda não fez nenhum Post.</strong>
        </div>
    @else
        <div class="card-header bg-white border-0">
            <a href="{{ app\Core\Helpers::url('admin/posts/create') }}" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Texto</th>
                        <th scope="col" class="text-start">Status</th>
                        <th scope="col" class="text-start">Ações</th>
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
                                    class="{{ $post->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }}"></i>
                            </td>

                            <td>
                                <div class="d-flex">

                                    <div class="me-3">
                                        <abbr title="Editar" class="ms-auto">
                                            <a href="{{ app\Core\Helpers::url('admin/categorias/edit/' . $post->id) }}"><i
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end text-secondary fs-6 ">Total de registros: <span
                    class="fw-bold ms-1 me-1">{{ $total['todos'] }}</span> -
                ativos:
                <span class="text-primary fw-bold me-1 ms-1">{{ $total['ativo'] }}</span> inativos: <span
                    class=" me-1 text-danger fw-bold ms-1">
                    {{ $total['inativo'] }}
                </span>
            </div>
        </div>
        <hr>
    @endif
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var categoriaId = button.data('id');
                var form = $(this).find('#deleteForm');

                if (categoriaId) {
                    var newAction = '{{ app\Core\Helpers::url('admin/posts/delete/') }}' + categoriaId;
                    console.log("URL de exclusão gerada: " + newAction);
                    form.attr('action', newAction);
                } else {
                    console.error("ID do produto não encontrado.");
                }
            });
        });
    </script>
@endsection
