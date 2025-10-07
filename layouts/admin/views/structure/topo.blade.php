<header class="bg-white">
    <h2>
        <label for="menu">
            <i class="fa-solid fa-bars-staggered" tooltip="tooltip" title="MENU"></i>
        </label>
    </h2>

    <div class="btn-group mb-2">
        <button type="button" class="btn bg-white dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static"
            aria-expanded="false">
            <i class="fa-solid fa-user me-2"></i>
            {{ $usuarioSessao->nome }}
        </button>
        <ul class="dropdown-menu dropdown-menu-lg-end">
            @if ($usuarioSessao->level == 3)
                <li>
                    <a class="dropdown-item" href="{{ app\Core\Helpers::url('/admin/dashboard') }}" tooltip="tooltip"
                        title="Perfil">
                        Painel de Controle
                    </a>
                </li>
            @endif
            <li>
                <a class="dropdown-item" href="" tooltip="tooltip" title="Perfil">
                    Perfil
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="{{ app\Core\Helpers::url('/admin/sair') }}" tooltip="tooltip"
                    title="Sair do Sistema">
                    Sair
                </a>
            </li>
        </ul>
    </div>

</header>
