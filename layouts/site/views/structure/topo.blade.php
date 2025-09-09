<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Document</title>
</head>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-dark"> <a
                href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"> <svg
                    class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg> </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <img class="img-fluid img-logo" src="layouts\site\assets\img\logo-blog-vb.png" alt="Logo">
                </li>
                <li><a href="{{ infinit\Nucleo\Helpers::url('') }}"
                        class="nav-link px-2 text-light text-decoration-underline-hover">Home</a>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn text-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categorias
                        </button>
                        <ul class="dropdown-menu">

                            @foreach ($categorias as $categoria)
                                <a href="{{ infinit\Nucleo\Helpers::url('categoria/' . $categoria->id) }}"
                                    class="dropdown-item">{{ $categoria->titulo }}</a>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li><a href="{{ infinit\Nucleo\Helpers::url('sobre-nos') }}" class="nav-link px-2 text-white">Sobre</a>
                </li>
            </ul>

            <form id="formBusca" method="POST" data-url-busca="{{ infinit\Nucleo\Helpers::url('buscar') }}"
                action="{{ infinit\Nucleo\Helpers::url('busca') }}"
                class="d-flex gap-2 col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">

                <input type="search" class="form-control form-control-dark text-bg-light  " name="busca"
                    id="busca" placeholder="Buscar..." aria-label="Search">
                {{-- <button class="btn btn-danger" type="submit">
                    <i class="fas fa-search"></i>
                </button> --}}
            </form>



            <div class="d-flex justify-content-center mt-3"id="buscaResultado">
            </div>

            <div class="text-end"> <button type="button" class="btn btn-outline-light me-2">Entrar</button> <button
                    type="button" class="btn btn-danger">Registrar</button> </div>
        </div>
    </div>
</header>




</html>
