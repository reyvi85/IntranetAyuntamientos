@if($routes->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
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
                    <td><img class="img-fluid img-thumbnail" src="{{asset($row->imagen)}}" width="250px"></td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td>{{$row->route_category->name}}</td>
                    <td class="text-center">
                        <a href="javascript:void(0)" wire:click="changeState({{$row->id}})">{!!($row->state == 1)?'<i class="fas fa-check-circle fa-2x" title="Activa"></i>':'<i class="fas fa-minus-circle fa-2x" title="Inactiva"></i>'!!}</a>
                    <td class="float-lg-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="viewRoute({{$row->id}})" title="Editar"><i class="fas fa-eye"></i> Ver ruta</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutes" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutesIntermediates" title="Rutas intermedias" wire:click="routeIntermediate('{{$row->id}}')"><i class="fas fa-map-signs"></i> Puntos intermedios</a>
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
