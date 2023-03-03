@if($reserves->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Ruta</th>
                <th scope="col">Fecha</th>
                <th class="text-center" scope="col"># Personas</th>
                <th class="text-center" scope="col">Confirmada</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($reserves as $row)
                <tr>
                    <td>{{$row->user->name}}</td>
                    <td>{{$row->user->email}}</td>
                    <td>{{$row->route->name}}</td>
                    <td>{{$row->fecha_reserva}}</td>
                    <td class="text-center">{{$row->num_person}}</td>
                    <td class="text-center">
                        {!!($row->state == 1)?'<i class="fas fa-check-circle fa-2x" title="Activa"></i>':'<i class="fas fa-minus-circle fa-2x" title="Inactiva"></i>'!!}
                    </td>
                    <td class="float-lg-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutesReserve" wire:click="viewReserve({{$row->id}})" title="Editar"><i class="fas fa-eye"></i> Ver reserva</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutesReserve" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormRoutesReserve" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a>

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
        {{$reserves->links()}}
    </div>
</div>
