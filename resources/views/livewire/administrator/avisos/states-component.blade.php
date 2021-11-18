<div>
    <div class="col-md-12 mt-4">
        @include('component.loading')
        <div class="form-row">
            <div class="form-group col-md-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Nombre del estado ....">
                @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group col-md-2">
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary btn-block" wire:click="update_state({{$stateSelected}})" wire:loading.attr="disabled" wire:target="update_state"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary btn-block" wire:click="store" wire:loading.attr="disabled" wire:target="store"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col">Avisos</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listStates as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td class="text-center">{{$row->warnings_count}}</td>
                        <td class="text-right">
                            <a href="javascript:void(0)" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalState"  wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash"></i> Eliminar estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Confirma que desea eliminar el estado <br>
                        <span class="text-danger font-weight-bold">{{$nameSelected}}</span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$stateSelected}})"><i class="fas fa-trash"></i> Sí, eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>


