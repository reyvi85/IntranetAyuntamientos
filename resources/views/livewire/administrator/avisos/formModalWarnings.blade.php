<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                @include('livewire.administrator.avisos.formWarning')
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('add')
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store, logo"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                    @break

                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update({{$warnigSelected}})" wire:loading.attr="disabled"  wire:target="update, logo"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$warnigSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="update, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

