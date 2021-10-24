<div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-10">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>
            <div class="form-group col-md-2">
                <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalForm" wire:click="createComunidad"><i class="fas fa-plus-circle"></i> Añadir</a>
            </div>
        </div>
@if ($comunidades->count())
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col" wire:click="order('name')"><i class="fas {{($sortDirection == 'asc')?'fa-sort-alpha-down':'fa-sort-alpha-up'}}"></i> Comunidades</th>
                <th colspan="3" class="text-center" scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comunidades as $row)
                <tr>
                    <th scope="row" class="align-middle" wire:click="$set('idProvincia', {{($idProvincia !=0 && $idProvincia == $row->id)?0:$row->id}})"><a href="javascript:void(0)"><i class="fas {{($idProvincia !=0 && $idProvincia == $row->id)?'fa-minus':'fa-plus'}}"></i></a></th>
                    <td class="align-middle "><a href="javascript:void(0)" wire:click="$set('idProvincia', {{($idProvincia !=0 && $idProvincia == $row->id)?0:$row->id}})">{{$row->name}}</a></td>
                    <td class="align-middle"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="editComunidad({{$row->id}})" title="Editar comunidad"><i class="fas fa-edit"></i></a></td>
                    <td class="align-middle"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trashComunidad({{$row->id}})" title="Eliminar comunidad"><i class="fas fa-trash"></i></a></td>
                    <td class="align-middle">
                        <a href="javascript:void(0)" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalForm" wire:click="createProvincia({{$row->id}})">
                            <i class="fas fa-plus-circle"></i> Provincias
                        </a></td>
                </tr>
                @if ($idProvincia !=0 && $idProvincia == $row->id)
                    @if ($row->provincias->count())
                        @foreach($row->provincias as $prv)
                            <tr>
                                    <td></td>
                                    <td colspan="2"><i class="fas fa-caret-right"></i> {{$prv->name}}</td>
                                    <td class="align-middle"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="editProvincia({{$prv->id}})" title="Editar provincia"><i class="fas fa-edit"></i></a></td>
                                    <td class="align-middle"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trashProvincia({{$prv->id}})" title="Eliminar provincia"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No hay provincias asociadas a esta Comunidad!</td>
                        </tr>
                    @endif
                @endif


            @endforeach
            </tbody>
        </table>
    @else
    <div class="text-center">No hay registros que mostrar.</div>
@endif
</div>
@include('livewire.administrator.comunidades-provincias.formModal', ['modalName'=>'modalForm'])

