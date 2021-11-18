<div wire:ignore.self class="modal fade" id="modalState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($modalModeDestroy)
                    <h3 class="text-center"> Confirma realmente que desea eliminar el elemento seleccionado?<br> <span class="text-danger font-weight-bolder">{{$name}}</span></h3>
                @else
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Nombre del estado ....">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group bg-{{$colorSelected}}">&nbsp;</div>
                        <div class="form-group">
                            @foreach($listColors as $key=>$value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="color-{{$key}}" value="{{$value}}" wire:model="colorSelected">
                                    <label class="form-check-label" for="color-{{$key}}">
                                       <span class="text-uppercase">{{$value}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>



                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_state({{$stateSelected}})" wire:loading.attr="disabled" wire:target="update_state"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$stateSelected}})"><i class="fas fa-trash"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store, update_state, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
