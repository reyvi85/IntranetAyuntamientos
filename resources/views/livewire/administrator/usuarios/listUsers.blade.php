<div class="form-row">
    <div class="form-group col-md-7">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    <div class="form-group col-md-3">
        <select class="form-control" wire:model="filterRol">
            <option value="">-- Roles --</option>
            @foreach($listRoles as $rol)
                <option value="{{$rol}}">{{$rol}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalUsers" wire:click="addUser"><i class="fas fa-plus-circle"></i> Añadir</a>
    </div>
</div>
@if ($usuarios->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" wire:click="order('id')" style="cursor: pointer">ID</th>
                <th scope="col" wire:click="order('name')" style="cursor: pointer">Nombre</th>
                <th scope="col" wire:click="order('email')" style="cursor: pointer">Email</th>
                <th scope="col">Rol</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->rol}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" role="button" data-toggle="modal" data-target="#modalUsers" wire:click="edit({{$user->id}})"><i class="fas fa-edit"></i> Editar</a>
                                @if (auth()->user()->rol =='Super-Administrador')
                                    <a class="dropdown-item" role="button" data-toggle="modal" data-target="#modalInstancias" wire:click="getUserInstance({{$user->id}})"><i class="fas fa-code"></i> Asignar instancia</a>
                                @elseif(auth()->user()->rol !='Super-Administrador' && auth()->user()->instances->count() >1 )
                                    <a class="dropdown-item" role="button" data-toggle="modal" data-target="#modalInstancias" wire:click="getUserInstance({{$user->id}})"><i class="fas fa-code"></i> Asignar instancia</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" role="button" data-toggle="modal" data-target="#modalUsers" wire:click="trashUser({{$user->id}})"><i class="fas fa-trash"></i> Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$usuarios->links()}}
        </div>
    </div>
@else
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            No hay registros que mostrar!
        </div>
    </div>
@endif
@include('livewire.administrator.usuarios.formModal')

@if (auth()->user()->rol =='Super-Administrador')
    @include('livewire.administrator.usuarios.instanciasModal')
@elseif(auth()->user()->rol !='Super-Administrador' && auth()->user()->instances->count() >1)
    @include('livewire.administrator.usuarios.instanciasModal')
@endif

