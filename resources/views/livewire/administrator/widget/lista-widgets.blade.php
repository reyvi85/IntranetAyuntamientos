@include('component.loading')
@if ($widgets->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Widget</th>
                <th scope="col" class="text-center">Noticia</th>
                <th scope="col">Enlace</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($widgets as $item)
                <tr>
                    <td class="align-middle">
                        <img class="img-fluid img-thumbnail rounded" src="{{asset($item->image)}}" width="150px">
                    </td>
                    <td class="align-middle"><h4>
                            {{$item->titulo}}<br>
                            <small class="text-muted">{{$item->subtitulo}}</small>
                        </h4></td>
                    <td class="align-middle text-center">{!! ($item->type)?'<i class="fas fa-check-circle"></i>':''!!}</td>
                    <td class="align-middle text-center">{!! (!$item->type)?'<i class="fas fa-check-circle"></i>':''!!}</td>
                    <td class="align-middle">@include('livewire.partial.switchesForm', ['campo' => 'active', 'row'=>$item->id, 'label'=>''])</td>
                    <td class="align-middle">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" id="edit-({{$item->id}})" wire:click="edit({{$item->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trash({{$item->id}})" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a>
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
        {{$widgets->links()}}
    </div>
</div>
