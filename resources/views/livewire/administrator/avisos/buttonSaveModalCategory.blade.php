@switch($modalConfig['action'])
    @case('edit-category')
        <button type="button" class="btn btn-primary" wire:click="update_category({{$categorySelected}})" wire:loading.attr="disabled" wire:target="update_category"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
    @break

    @case('trash-category')
    <button type="button" class="btn btn-danger" wire:click="destroyCategory({{$categorySelected}})" wire:loading.attr="disabled" wire:target="destroyCategory"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
    @break

    @case('store-sub-category')
    <button type="button" class="btn btn-primary" wire:click="storeSubCategory({{$categorySelected}})" wire:loading.attr="disabled"  wire:target="storeSubCategory"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
    @break

    @case('edit-sub-category')
    <button type="button" class="btn btn-primary" wire:click="update_Subcategory({{$subCategorySelected}})" wire:loading.attr="disabled" wire:target="update_Subcategory"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
    @break

    @case('trash-sub-category')
    <button type="button" class="btn btn-danger" wire:click="destroySubCategory({{$subCategorySelected}})" wire:loading.attr="disabled" wire:target="destroySubCategory"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
    @break

    @default
    <button type="button" class="btn btn-primary" wire:click="storeCategory" wire:loading.attr="disabled" wire:target="storeCategory"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>

@endswitch
