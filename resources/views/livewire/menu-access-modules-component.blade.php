<div>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-mouse-pointer"></i> Módulos
        </a>
        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
            @foreach($modulos as $item)
                <a class="dropdown-item" href="{{route($item['routeName'])}}"><i class="fas {{$item['icon']}}"></i> {{$item['modulo']}}</a>
            @endforeach
        </div>
    </li>
</div>
