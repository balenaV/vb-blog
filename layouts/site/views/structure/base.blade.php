<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap e CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="layouts/assets/css/style.css">
    <link rel="stylesheet" href="layouts\site\assets\css\site.css">



    <title> @yield('title', 'Meu Site') </title>
</head>

<body>
    @include('structure.topo')

    <main class="container mt-4">
        @yield('content')
    </main>

    @include('structure.rodape')

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- Boostrap e JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="{{ infinit\Nucleo\Helpers::url('/layouts/assets/js/scripts.js') }}"></script>
    <script src="{{ infinit\Nucleo\Helpers::url('/layouts/site/assets/js/site.js') }}"></script>


</body>

</html>
