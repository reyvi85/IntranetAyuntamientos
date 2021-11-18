<div class="row mt-4">
    <div class="col-md-12">
        @include('component.loading')
        <div class="form-row">
            <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?7:10}}">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
            </div>

            @if (auth()->user()->rol =='Super-Administrador')
                <div class="form-group col-md-3">
                    @php($label = false)
                    @php($ModelName = 'instancias')
                    @include('livewire.partial.comboInstancias')

                </div>
            @endif

            <div class="form-group col-md-2">
                <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalForm" wire:click="addCategory"><i class="fas fa-plus-circle"></i> Añadir</a>
            </div>
        </div>
        <hr>
        @if ($categorias->count())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="link_pointer" scope="col" wire:click="order('name')">Categoría</th>
                        <th scope="col" class="text-center link_pointer" wire:click="order('sub_categories_count')" style="cursor: pointer;">Subcategorías</th>
                        <th colspan="2" class="text-center" scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categorias as $ctg)
                        <tr>
                            <th scope="row" class="align-middle" wire:click="$set('idCategory', {{($idCategory !=0 && $idCategory == $ctg->id)?0:$ctg->id}})"><a href="javascript:void(0)"><i class="fas {{($idCategory !=0 && $idCategory == $ctg->id)?'fa-minus':'fa-plus'}}"></i></a></th>
                            <td>{{$ctg->name}}</td>
                            <td class="text-center">{{$ctg->sub_categories_count}}</td>
                            <td class="align-middle text-center">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="editCategory({{$ctg->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trashCategory({{$ctg->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                            </td>

                            <td class="align-middle">
                                <a href="javascript:void(0)" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalForm" wire:click="addSubCategory({{$ctg->id}})">
                                    <i class="fas fa-plus-circle"></i> Sub - categoría
                                </a>
                            </td>
                        </tr>
                        @if ($idCategory !=0 && $idCategory == $ctg->id)
                            @if ($ctg->sub_categories->count())
                                @foreach($ctg->sub_categories as $sb)
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><i class="fas fa-caret-right"></i> {{$sb->name}}</td>
                                        <td class="align-middle text-right">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="editSubCategory({{$sb->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trashSubCategory({{$sb->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <td class="align-middle text-right w-25"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No hay sub categorías asociadas!</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center">No hay registros que mostrar.</div>
        @endif
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
                {{$categorias->links()}}
            </div>
        </div>
        @include('livewire.administrator.avisos.formModalCategories')
    </div>
</div>
