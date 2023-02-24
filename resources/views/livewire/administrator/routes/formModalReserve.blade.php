<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormRoutesReserve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('modalModeDestroy', false)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($modalModeDestroy)
                    <h3 class="text-center"> Confirma realmente que desea eliminar esta reserva<br> <span class="text-danger font-weight-bolder">Eliminar reserva</span>?</h3>
                @else
                    @include('livewire.administrator.routes.form.reserveForm')
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                    @switch($modalConfig['action'])
                        @case('edit')
                        <button type="button" class="btn btn-primary" wire:click="routesUDPT({{$routeSelected}})"  wire:loading.attr="disabled" wire:target="routesUDPT, imagen"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                        @break

                        @case('trash')
                        <button type="button" class="btn btn-danger" wire:click="destroy({{$routeSelected}})" wire:loading.attr="disabled"  wire:target="destroy"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                        @break

                        @default
                        <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store, image"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                    @endswitch
                    <div class="text-center text-muted" wire:loading wire:target="store, image, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
