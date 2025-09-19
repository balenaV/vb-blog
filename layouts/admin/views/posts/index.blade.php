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
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
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

                            <td class="text-center">
                                <abbr title="Editar">
                                    <a href="{{ app\Core\Helpers::url('admin/posts/edit/' . $post->id) }}"><i
                                            class="fa-solid fa-pencil text-warning"></i></a>
                                </abbr>
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
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var postId = button.data('id');
                var form = $(this).find('#deleteForm'); // Encontra o formulário dentro do modal
                var newAction = '{{ app\Core\Helpers::url('admin/posts/delete/') }}/' + postId;
                form.attr('action', newAction);
            });
        });
    </script>
@endsection
