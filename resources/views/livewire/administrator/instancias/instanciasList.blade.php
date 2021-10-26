    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>
        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalInstancia"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>

    @if ($instancias->count())
    <div class="row">
        <div class="col-md-12">
            @foreach($instancias as $row)
                <ul class="list-group mt-2">
                    <li class="list-group-item active"><h5><i class="fas fa-university"></i> {{$row->name}}</h5></li>
                    <li class="list-group-item"><span class="font-weight-bold text-uppercase">Comunidad: </span> {{$row->province->community->name}}</li>
                    <li class="list-group-item"><span class="font-weight-bold text-uppercase">Provincia: </span> {{$row->province->name}}</li>
                    <li class="list-group-item"> <span class="font-weight-bold text-uppercase">Municipio: </span> {{$row->municipio}}</li>
                    <li class="list-group-item"> <span class="font-weight-bold text-uppercase">Barrio: </span> {{$row->barrio}}</li>
                    <li class="list-group-item"> <span class="font-weight-bold text-uppercase">Código POstal: </span> {{(is_null($row->postal_code)?'-':$row->postal_code)}}</li>
                    <li class="list-group-item"> <span class="font-weight-bold text-uppercase">Key:</span>  {{$row->key}}</li>
                    <li class="list-group-item d-flex justify-content-end">
                        <a class="btn btn-primary mr-2" role="button" data-toggle="modal" data-target="#modalInstancia" wire:click="edit('{{$row->id}}')"><i class="fas fa-edit"></i> Editar</a>
                        <a class="btn btn-secondary mr-2" role="button" data-toggle="modal" data-target="#modalUsers" wire:click="selectInstance({{$row->id}})"><i class="fas fa-users"></i> Asignar usuarios</a>
                        <a class="btn btn-danger" role="button" data-toggle="modal" data-target="#modalInstancia" wire:click="trashInstance('{{$row->id}}')"><i class="fas fa-trash"></i> Eliminar</a>
                    </li>
                </ul>
            @endforeach

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$instancias->links()}}
        </div>
    </div>
@else
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            No hay registros que mostrar!
        </div>
    </div>
@endif

@include('livewire.administrator.instancias.formModal')
@include('livewire.administrator.instancias.usuariosModal')


