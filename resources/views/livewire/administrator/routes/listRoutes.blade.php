@if($routes->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoría</th>
                <th class="text-center" scope="col">Activa</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td>{{$row->route_category->name}}</td>
                    <td class="text-center">{{$row->state}}</td>
                    <td class="float-lg-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutesIntermediates" wire:click="edit({{$row->id}})" title="Rutas intermedias"><i class="fas fa-map-signs" wire:click="$emitUp('routeIntermediate', {{$row->id}})"></i> Rutas intermedias</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a>

                            </div>
                        </div>
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
