<div>
    @include('component.loading')
    <div class="form-row mt-2">
        <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?4:7}}">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        @if (auth()->user()->rol =='Super-Administrador')
            <div class="form-group col-md-3">
                @php($label = false)
                @php($ModelName = 'instancias')
                @include('livewire.partial.comboInstancias')

            </div>
        @endif

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
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->telefono}}</td>
                        <td>{{$row->category_busine->name}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownOption">
                                    <a class="dropdown-item" href="javascript:void(0)"  title="Productos"><i class="fas fa-shopping-bag"></i> Productos</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormBusiness" wire:click="edit({{$row->id}})" title="Editar comercio"><i class="fas fa-edit"></i> Editar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormBusiness" wire:click="trash({{$row->id}})" title="Eliminar comercio"><i class="fas fa-trash"></i> Eliminar</a>
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

    @else
        <p class="text-center text-muted">No hay comercios que mostrar!</p>
    @endif
    @include('livewire.administrator.business.formModalBusiness')
</div>
