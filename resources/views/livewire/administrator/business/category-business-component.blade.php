<div class="mt-2">
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>
        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormCategory" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>

    @if ($listCategory->count())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" wire:click="order('id')" style="cursor: pointer">ID</th>
                    <th scope="col" wire:click="order('name')" style="cursor: pointer">Nombre</th>
                    <th scope="col" wire:click="order('business_count')" style="cursor: pointer">Empresas</th>
                    <th scope="col">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($listCategory as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->business_count}}</td>
                        <td class="float-right">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="edit({{$item->id}})" title="Editar categoría"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="trash({{$item->id}})" title="Eliminar categoría"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted">No hay categorías que mostrar!</p>
    @endif

    @include('livewire.administrator.business.formModalCategory')

</div>

