<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sidebar</title>
</head>


<h4 class="text-center fw-bold">
    Categorias
</h4>

<ul class="list-group list-group-flush">

    @foreach ($categorias as $categoria)
        <a href="{{ infinit\Nucleo\Helpers::url('categoria/' . $categoria->id) }}"
            class="list-group-item list-group-item-flush">{{ $categoria->titulo }}</a>
    @endforeach

</ul>

</html>
