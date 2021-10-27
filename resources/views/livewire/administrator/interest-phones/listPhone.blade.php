@include('component.loading')
<div class="form-row">
    <div class="form-group col-md-10">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    <div class="form-group col-md-2">
        <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormBusiness" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
    </div>
</div>

<hr>

@if ($telefonos->count())
    <div class="table-responsive">
        <table class="table">
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
                    <td></td>
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

