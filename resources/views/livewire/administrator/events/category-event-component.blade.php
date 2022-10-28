<div class="mt-4">
    @include('component.loading')
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?10:8}}">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
            </div>


            <div class="form-group col-md-2">
                <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormCategory" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
            </div>
        </div>
        <hr>
        @if ($listCategory->count())
            <div class="table-responsive table-striped">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>

                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listCategory as $item)
                        <tr>
                            <td>{{$item->id}} - {{$item->name}}</td>
                            <td class="text-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="edit({{$item->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="trash({{$item->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @else
            <p class="text-center text-muted">No hay registros que mostrar!</p>
        @endif
    </div>
    @include('livewire.administrator.events.formModalEventCategory')
</div>
