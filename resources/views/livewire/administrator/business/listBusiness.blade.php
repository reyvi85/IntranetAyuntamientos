@include('component.loading')
<div class="form-row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>
    <div class="form-group col-md-3">
        <select class="form-control" wire:model="instanceSelected">
            <option value="">-- Instancias --</option>
            @foreach($listInstances as $int)
                <option value="{{$int->id}}">{{$int->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-3">
        <select class="form-control" wire:model="categorySelected">
            <option value="">-- Categorías --</option>
            @foreach($listCategoryBusiness as $ctg)
                <option value="{{$ctg->id}}">{{$ctg->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormBusiness" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
    </div>
</div>

<hr>
@if ($listBusiness->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" wire:click="order('id')" style="cursor: pointer">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Categoría</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($listBusiness as $row)
                <tr>
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->telefono}}</td>
                    <td>{{$row->category_busine->name}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownOption">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormBusiness" wire:click="edit({{$row->id}})" title="Editar comercio"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormBusiness" wire:click="edit({{$row->id}})" title="Eliminar comercio"><i class="fas fa-trash"></i> Eliminar</a>
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
            {{$listBusiness->links()}}
        </div>
    </div>

    @include('livewire.administrator.business.formModalBusiness')
@else
    <p class="text-center text-muted">No hay comercios que mostrar!</p>
@endif
