<input type="checkbox" id="menu">
<div class="sidebar">
    <div class="sidebarLogo">
        <a href="{{ app\Core\Helpers::url('admin/dashboard') }}" data-bs-toggle="tooltip" title="Página Inicial">
            <div class=" img-fluid  img-logo">
                <img src="{{ app\Core\Helpers::url('/layouts/admin/assets/img/logo-blog-vb.png') }}"
                    alt=" {{ constant('SITE_NOME') }}" />
            </div>
        </a>
    </div>

    <div class="sidebarMenu">
        <ul>
            <li class="sidebarTitulo">
                Administração
            </li>
            <li>
                <a href="{{ app\Core\Helpers::url('admin/posts/index') }}" tooltip="tooltip"
                    title="Administração de Posts">
                    <i class="fa-solid fa-file-pen"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li>
                <a href="{{ app\Core\Helpers::url('admin/categorias/indexCategoria') }}" tooltip="tooltip"
                    title="Administração de Categorias">
                    <i class="fa-solid fa-list"></i>
                    <span>Categorias</span>
                </a>
            </li>
            <li>
                <a href="#" tooltip="tooltip" title="Administração de Usuários">
                    <i class="fas fa-users"></i>
                    <span>Usuários</span>
                </a>
            </li>
        </ul>
    </div>

</div>
