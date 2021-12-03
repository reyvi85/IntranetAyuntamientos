@include('component.loading')
    @include('livewire.administrator.noticias.filterForm')
<hr>
@if ($news->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="2">Noticia</th>
            <th scope="col" class="link-pointer" wire:click="order('residentes')">Residentes</th>
            <th scope="col" class="link-pointer" wire:click="order('visitantes')">Visitantes</th>
            <th scope="col" class="link-pointer" wire:click="order('inicio')">Inicio</th>
            <th scope="col" class="link-pointer" wire:click="order('fecha_inicio')">Duración</th>
            <th scope="col" class="link-pointer" wire:click="order('active')">Activación</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($news as $item)
                <tr>
                    <td class="align-middle">
                        <img class="img-fluid img-thumbnail rounded" src="{{asset($item->image)}}" width="150px">
                    </td>
                    <td class="align-middle">
                        <h4>
                            {{$item->titulo}}<br>
                            <small class="text-muted">{{$item->subtitulo}}</small>
                        </h4>
                    </td>
                    <td class="align-middle text-center">
                        @include('livewire.administrator.noticias.switchesForm', ['campo' => 'residentes', 'row'=>$item->id, 'label'=>''])
                    </td>
                    <td class="align-middle text-center">
                        @include('livewire.administrator.noticias.switchesForm', ['campo' => 'visitantes', 'row'=>$item->id, 'label'=>''])
                    </td>
                    <td class="align-middle text-center">
                        @include('livewire.administrator.noticias.switchesForm', ['campo' => 'inicio', 'row'=>$item->id, 'label'=>''])
                   </td>
                    <td class="align-middle text-center">
                        {{$item->fecha_full}}
                    </td>
                    <td class="align-middle text-center">
                        @include('livewire.administrator.noticias.switchesForm', ['campo' => 'active', 'row'=>$item->id, 'label'=>''])
                    </td>
                    <td class="align-middle text-center">

                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" id="edit-({{$item->id}})" wire:click="edit({{$item->id}})" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalFormDestroy" wire:click="trash({{$item->id}})" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a>
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
        {{$news->links()}}
    </div>
</div>
@include('livewire.administrator.noticias.formModalNoticias');
@include('livewire.administrator.noticias.formModalDestroy');

