<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormDestroy"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('modalModeDestroy', false)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <h3 class="text-center"> Confirma realmente que desea eliminar esta noticia<br> <span class="text-danger font-weight-bolder">{{$titulo}}</span>?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-danger" wire:click="destroy({{$postSelected}})" wire:loading.attr="disabled"  wire:target="destroy"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                <div class="text-center text-muted" wire:loading wire:target="destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
