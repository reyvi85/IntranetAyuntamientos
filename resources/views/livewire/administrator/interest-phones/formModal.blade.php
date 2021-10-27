<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="formGroupExampleInput">Nombre:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" wire:model="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Descripción:</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="formGroupExampleInput" wire:model="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Teléfono:</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="formGroupExampleInput" wire:model="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    @include('livewire.partial.comboInstancias')
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('add')
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                    @break

                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_phone({{$phoneSelected}})" wire:target="update_phone" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$phoneSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="update_phone, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

