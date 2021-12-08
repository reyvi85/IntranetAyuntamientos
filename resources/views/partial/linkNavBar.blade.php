@auth
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> Home</a>
    </li>
    <!----- LINK DE SUPER-ADMINISTRADOR------->
    @includeWhen(auth()->user()->isRole('Super-Administrador'), 'partial.superAdminLink')
    <!----- LINK DE ADMINISTRADOR-INSTANCIAS------->
    @includeWhen(auth()->user()->isRole('Administrador-Instancia'), 'partial.adminInstanciaLink')
    <!----- LINK DE GESTOR-INSTANCIAS------->
    @includeWhen(auth()->user()->isRole('Gestor-Instancia'), 'partial.gestorInstanciaLink')
@endauth




