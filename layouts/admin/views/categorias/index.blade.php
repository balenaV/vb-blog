@extends('dashboard')


@section('titulo')
    Categorias
@endsection
@section('content')
    @if (!$categorias)
        <div class="alert alert-warning" role="alert">Nenhuma Categoria foi criado.</strong>
        </div>
    @else
        <div class="card-header bg-white border-0">
            <a href="{{ app\Core\Helpers::url('admin/categorias/create') }}" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Texto</th>
                        <th scope="col" class="text-center">Status</th>
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
                                <i
                                    class="{{ $categoria->status == 1 ? 'fa-solid fa-check text-primary' : 'fa-solid fa-close text-danger ' }}  "></i>
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
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                    var newAction = '{{ app\Core\Helpers::url('admin/categorias/delete/') }}' + categoriaId;
                    console.log("URL de exclusão gerada: " + newAction);
                    form.attr('action', newAction);
                } else {
                    console.error("ID da categoria não encontrado.");
                }
            });
        });
    </script>
@endsection
