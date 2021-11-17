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

                    @if (auth()->user()->rol == 'Super-Administrador' && $workSubCategory == false)
                        <div class="form-group">
                            @php($label = true)
                            @php($ModelName = 'instanceSelected')
                            @include('livewire.partial.comboInstancias')
                        </div>
                    @endif

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @include('livewire.administrator.avisos.buttonSaveModalCategory')
                <div class="text-center text-muted" wire:loading wire:target="storeCategory, update_category, destroyCategory, storeSubCategory, update_Subcategory, destroySubCategory"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

