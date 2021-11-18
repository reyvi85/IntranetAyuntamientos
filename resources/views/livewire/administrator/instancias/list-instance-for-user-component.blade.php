<div>
@if ($list_intance->count())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-code"></i> Instancias <span class="badge badge-light">{{$list_intance->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                @foreach ($list_intance as $instance)
                    <a class="dropdown-item {{($instance->id == $instanceSelected->id)?'active':''}}" href="javascript:void(0)" wire:click="changeInstance({{$instance->id}})">{{$instance->name}}</a>
                @endforeach
            </div>
        </li>
@endif
</div>


