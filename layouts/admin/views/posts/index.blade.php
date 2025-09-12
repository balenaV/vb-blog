@extends('dashboard')


@section('titulo')
    Meus Posts
@endsection
@section('content')
    @if (!$posts)
        <div class="alert alert-warning" role="alert">Você ainda não fez nenhum Post.</strong>
        </div>
    @else
        @foreach ($posts as $post)
        @endforeach
    @endif
@endsection
