<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rodape</title>
</head>

<footer class="py-3 my-4 bg-dark">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="{{ infinit\Nucleo\Helpers::url('') }}" class="nav-link px-2 text-light">Home</a>
        </li>
        <li class="nav-item"><a href="{{ infinit\Nucleo\Helpers::url('sobre-nos') }}"
                class="nav-link px-2 text-light">Sobre</a></li>
    </ul>
    <p class="text-center text-light">&copy;{{ constant('SITE_NOME') }}</p>
</footer>

</html>
