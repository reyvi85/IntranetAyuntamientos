@switch($modalConfig['action'])
    @case('add-comunidad')
    <button type="button" class="btn btn-primary" wire:click="storeComunidad" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
    @break

    @case('edit-comunidad')
        <button type="button" class="btn btn-primary" wire:click="updateComunidad({{$comunidadID}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
    @break

    @case('trash-comunidad')
    <button type="button" class="btn btn-danger" wire:click="destroyComunidad({{$comunidadID}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
    @break

    @case('add-prov')
    <button type="button" class="btn btn-primary" wire:click="storeProvincia({{$comunidadID}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
    @break

    @case('edit-prov')
    <button type="button" class="btn btn-primary" wire:click="updateProvincia({{$provinciaID}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
    @break

    @case('trash-prov')
    <button type="button" class="btn btn-danger" wire:click="destroyProvincia({{$provinciaID}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
    @break

@endswitch
