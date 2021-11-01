@include('component.loading')
<div class="form-row">
    <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?6:10}}">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>
    @if (auth()->user()->rol =='Super-Administrador')
        <div class="form-group col-md-4">
            @php($label = false)
            @php($ModelName = 'instancias')
            @include('livewire.partial.comboInstancias')
        </div>
    @endif

    <div class="form-group col-md-2">
        <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalForm" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
    </div>
</div>

<hr>

@if ($telefonos->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Teléfono</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($telefonos as $tlf)
                <tr>
                    <td>{{$tlf->name}}</td>
                    <td>{{$tlf->description}}</td>
                    <td>{{$tlf->phone}}</td>
                    <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="edit({{$tlf->id}})" title="Editar comercio"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trash({{$tlf->id}})" title="Eliminar comercio"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$telefonos->links()}}
        </div>
    </div>

@else
    <p class="text-center text-muted">No hay teléfonos que mostrar!</p>
@endif
@include('livewire.administrator.interest-phones.formModal')
