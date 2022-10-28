<div wire:ignore.self class="modal fade" id="modalFormCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormCategory"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('modalModeDestroy', false)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($modalModeDestroy)
                    <h3 class="text-center"> Confirma realmente que desea eliminar esta categoría<br> <span class="text-danger font-weight-bolder">{{$name}}</span>?</h3>
                @else
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Imagen:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFileLang" lang="es" wire:model="image" accept=".png, .jpg, .jpeg">
                            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                            @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="text-center text-muted align-middle" wire:loading wire:target="image">
                            <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
                        </div>

                        @if ($image)
                            <img class="img-fluid img-thumbnail rounded" src="{{ $image->temporaryUrl() }}">
                        @elseif(!is_null($imageSelected))
                            <img class="img-fluid img-thumbnail rounded" src="{{asset($imageSelected)}}">
                        @endif
                    </div>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_category({{$categorySelected}})"  wire:loading.attr="disabled" wire:target="update_category, image"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$categorySelected}})" wire:loading.attr="disabled"  wire:target="destroy"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store, image"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store, image, update_category, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
