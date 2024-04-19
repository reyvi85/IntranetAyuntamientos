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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" wire:model.defer="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Descripción:</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="formGroupExampleInput" wire:model.defer="description">
                        @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Teléfono:</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="formGroupExampleInput" wire:model.defer="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>


                        <div class="row">
                            <div class="col-md-12">
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
                                    <div class="text-center text-muted align-middle" wire:loading.grid wire:target="image">
                                        <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
                                    </div>

                                    @if ($image)
                                        <img class="img-fluid img-thumbnail rounded" src="{{ $image->temporaryUrl() }}">
                                    @elseif(!is_null($imagePhone))
                                        <img class="img-fluid img-thumbnail rounded" src="{{asset($imagePhone)}}">
                                    @endif
                                </div>
                            </div>

                        </div>


                        @php($label = true)
                        @php($ModelName = 'instanceSelected')
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
                    <button type="button" class="btn btn-primary" wire:click="update_phone({{$phoneSelected}})" wire:target="update_phone,image" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$phoneSelected}})" wire:target="destroy" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store, update_phone, destroy, image"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

