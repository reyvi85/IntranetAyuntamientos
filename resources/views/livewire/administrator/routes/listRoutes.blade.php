@if($routes->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td class="float-lg-right">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-center text-muted">No hay registros que mostrar!</p>
@endif

<div class="row mt-3">
    <div class="col-md-12 d-flex justify-content-end">
        {{$routes->links()}}
    </div>
</div>
