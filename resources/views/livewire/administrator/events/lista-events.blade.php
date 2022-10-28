@if($events->count())
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col" class="text-center">Categoría</th>
                <th scope="col">Link</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $row)
            <tr>
                <th scope="row">{{$row->titulo}}</th>
                <td>{{$row->f_inicio}}</td>
                <td>{{$row->f_fin}}</td>
                <td class="text-center">{{$row->event_category->name}}</td>
                <td>
                   @if(!is_null($row->link) && $row->link!="")<a href="{{$row->link}}" target="_blank"><i class="fas fa-link fa-2x"></i></a>@endif
                </td>
                <td class="text-right align-middle">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormEvents" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormEvents" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
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
        {{$events->links()}}
    </div>
</div>

