@include('component.loading')
<div class="form-row">
    <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?7:10}}">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    @if (auth()->user()->rol =='Super-Administrador')
        <div class="form-group col-md-3">
            @php($label = false)
            @php($ModelName = 'instancias')
            @include('livewire.partial.comboInstancias')

        </div>
    @endif

    <div class="form-group col-md-2">
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalForm" wire:click="add" id="addNews"><i class="fas fa-plus-circle"></i> Añadir</button>
    </div>

</div>
<hr>
@if ($widgets->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Widget</th>

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
                    <td class="align-middle">@include('livewire.partial.switchesForm', ['campo' => 'active', 'row'=>$item->id, 'label'=>''])</td>
                    <td class="align-middle">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="edit({{$item->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalForm" wire:click="trash({{$item->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
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
@include('livewire.administrator.widget.formModal')
