@extends('dashboard')


@section('titulo')
    Meus Posts
@endsection
@section('content')
    @if (!$posts)
        <div class="alert alert-warning" role="alert">Você ainda não fez nenhum Post.</strong>
        </div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Texto</th>
                        <th scope="col">Status</th>
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

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
    @endif
@endsection
