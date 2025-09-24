@extends('structure.base')

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ app\Core\Helpers::url('layouts/admin/assets/css/login.css') }}">


    <title>Responsive Login Form</title>
</head>

<body>

    <!--=============== LOGIN IMAGE ===============-->
    <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />
        </mask>

        <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />

            <!-- Insirir imagem aqui (tamanho recomendado: 1000 x 1200) -->
            <image class="login__img" href="{{ app\Core\Helpers::url('layouts/admin/assets/images/bg-img.jpg') }}" />
        </g>
    </svg>

    <!-- === LOGIN === -->
    <div class="login container grid " id="loginAccessRegister">
        <!-- === ACESSO  LOGIN === -->
        <div class="login__access">
            <h1 class="login__title">Entrar na sua conta.</h1>

            <div class="login__area">
                <form action="" class="login__form">
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="email" id="email" required placeholder="" class="login__input">
                            <label for="email" class="login__label">Email</label>
                            <i class="ri-mail-fill login__icon"></i>
                        </div>

                        <div class="login__box">
                            <input type="password" id="password" required placeholder="" class="login__input">
                            <label for="password" class="login__label">Senha</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                        </div>
                    </div>

                    <a href="#" class="login__forgot">Esqueci a senha</a>

                    <button type="submit" class="login__button">Entrar</button>
                </form>

                <div class="login__social">
                    <p class="login__social-title">Ou conecte-se com</p>

                    <div class="login__social-links">
                        <a href="" class="login__social-link"><img
                                src="{{ app\Core\Helpers::url('layouts/admin/assets/images/icon-google.svg') }}"
                                alt="image" class="login__social-img"></a>
                        <a href="" class="login__social-link"><img
                                src="{{ app\Core\Helpers::url('layouts/admin/assets/images/icon-facebook.svg') }}"
                                alt="image" class="login__social-img"></a>
                        <a href="" class="login__social-link"><img
                                src="{{ app\Core\Helpers::url('layouts/admin/assets/images/icon-apple.svg') }}"
                                alt="image" class="login__social-img"></a>
                    </div>
                </div>

                <p class="login__switch">
                    Ainda não tem uma conta?
                    <button id="loginButtonRegister">Registrar-se</button>
                </p>
            </div>
        </div>
        <!-- === REGISTRO  === -->
        <div class="login__register">
            <h1 class="login__title">Registrar-se.</h1>

            <div class="login__area">

                <form action="" class="login__form">
                    <div class="login__content grid">
                        <div class="login__group grid">

                            <!-- NOME -->
                            <div class="login__box">
                                <input type="text" required placeholder="" class="login__input">
                                <label for="" class="login__label">
                                    Nome
                                </label>
                                <i class="ri-id-card-fill login__icon"></i>
                            </div>

                            <!-- SOBRENOME -->
                            <div class="login__box">
                                <input type="text" name="" required placeholder="" class="login__input">
                                <label for="" class="login__label">Sobrenome</label>
                                <i class="ri-id-card-fill login__icon"></i>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="login__box">
                            <input type="email" id="emailCreate" required placeholder="" class="login__input">
                            <label for="emailCreate" class="login__label">Email</label>

                            <i class="ri-mail-fill login__icon"></i>
                        </div>

                        <!-- SENHA -->
                        <div class="login__box">
                            <input type="password" id="passwordCreate" required placeholder="" class="login__input">
                            <label for="passwordCreate" class="login__label">Senha</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                        </div>
                    </div>

                    <button type="submit" class="login__button">Registrar</button>
                </form>

                <p class="login__switch">Já possui uma conta?
                    <button id="loginButtonAccess">Entrar</button>
                </p>

            </div>
        </div>

    </div>


    <!--===== MAIN JS =====-->
    <script src="{{ app\Core\Helpers::url('layouts/admin/assets/js/login.js') }}"></script>

</body>

</html>
