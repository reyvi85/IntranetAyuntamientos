<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cogs"></i> Configuración
    </a>
    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="{{route('comunidades.provincias')}}"><i class="fas fa-map-marker"></i> Comunidades y provincias</a>
        <a class="dropdown-item" href="{{route('instancias')}}"><i class="fas fa-code"></i> Instancias</a>
        <a class="dropdown-item" href="{{route('usuarios')}}"><i class="fas fa-users"></i> Usuarios</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{route('category-business')}}"><i class="fas fa-th-list"></i> Categorías de comercios</a>
        <a class="dropdown-item" href="{{route('business.index')}}"><i class="fas fa-euro-sign"></i> Comercios</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{route('phones.index')}}"><i class="fas fa-phone"></i> Teléfonos</a>
    </div>
</li>
