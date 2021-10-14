@auth
    <!----- LINK DE SUPER-ADMINISTRADOR------->
    @includeWhen(auth()->user()->isRole('Super-Administrador'), 'partial.superAdminLink')
    <!----- LINK DE ADMINISTRADOR-INSTANCIAS------->
    @includeWhen(auth()->user()->isRole('Administrador-Instancia'), 'partial.adminInstanciaLink')
    <!----- LINK DE GESTOR-INSTANCIAS------->
    @includeWhen(auth()->user()->isRole('Gestor-Instancia'), 'partial.gestorInstanciaLink')
@endauth




