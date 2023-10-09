@include('component.loading')
<div class="form-row">
    <div class="form-group col-md-10">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    <div class="form-group col-md-2">
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalForm" wire:click="add" id="addNews"><i class="fas fa-plus-circle"></i> Añadir</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">DNI</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($listClient as $row)
            <tr>
                <th scope="row">{{$row->Nombre}}</th>
                <td>{{$row->Dni}}</td>
                <td><i class="fas {{($row->Active)?'fa-check-circle':'fa-minus-circle'}}"></i></td>
                <td class="text-right">
                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" id="edit-({{$row->id}})" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a>
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
        {{$listClient->links()}}
    </div>
</div>
@include('livewire.administrator.ampa.formModal')
