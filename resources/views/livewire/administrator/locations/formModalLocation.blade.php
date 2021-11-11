<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h3 class="text-center"> Confirma realmente que desea eliminar esta categoría<br> <span class="text-danger font-weight-bolder">{{$name}}</span>?</h3>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @php($label = true)
                                @php($ModelName = 'instanceSelected')
                                @include('livewire.partial.comboInstancias')
                            </div>

                            @if ($instanceSelected)
                                <div class="form-group">
                                    <label>Categoría: <span wire:loading.delay wire:target="instanceSelected"><i class="fas fa-spinner fa-spin"></i></span></label>
                                    <select class="form-control" wire:model="categorySelected">
                                        <option value="">-- Categorías --</option>
                                        @foreach($listCategoryForAdd as $ctg)
                                            <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" wire:model.defer="description">
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ubicacion">Ubicación:</label>
                                <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" wire:model.defer="ubicacion">
                                @error('ubicacion')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" wire:model.defer="telefono">
                                @error('telefono')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="web">Web:</label>
                                <input type="text" class="form-control @error('web') is-invalid @enderror" id="web" wire:model.defer="web" placeholder="http://">
                                @error('web')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagen:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFileLang" lang="es" wire:model="image">
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
                                @elseif(!is_null($imageLocation))
                                    <img class="img-fluid img-thumbnail rounded" src="{{asset($imageLocation)}}">
                                @endif
                            </div>

                            <div class="form-inline d-flex justify-content-center">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="ControlInlineVisitantes" wire:model="visitantes">
                                    <label class="custom-control-label" for="ControlInlineVisitantes">Visitantes</label>
                                </div>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="ControlInlineResidentes" wire:model="residentes">
                                    <label class="custom-control-label" for="ControlInlineResidentes">Residentes</label>
                                </div>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="ControlInlineInicio" wire:model="inicio">
                                    <label class="custom-control-label" for="ControlInlineInicio">Página de inicio</label>
                                </div>
                            </div>



                        </div>

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
                <div class="text-center text-muted" wire:loading wire:target="store, update_category, image, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
