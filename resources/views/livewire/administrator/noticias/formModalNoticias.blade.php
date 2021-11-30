<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h3 class="text-center"> Confirma realmente que desea eliminar esta noticia<br> <span class="text-danger font-weight-bolder">{{$titulo}}</span>?</h3>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @php($label = true)
                                @php($ModelName = 'instanceSelected')
                                @include('livewire.partial.comboInstancias')
                            </div>

                            <div class="form-group">
                                <label for="name">Titulo:</label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="name" wire:model.defer="titulo">
                                @error('titulo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Subtitulo:</label>
                                <input type="text" class="form-control @error('subtitulo') is-invalid @enderror" id="description" wire:model.defer="subtitulo">
                                @error('subtitulo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group" wire:ignore>
                                <label for="ubicacion">Fecha de inicio / fin:</label>
                                <input type="text" class="form-control @error('fechaNews') is-invalid @enderror" name="fechaNews" id="fechaNews" wire:model="fechaNews" value="{{$fechaNews}}">
                                @error('fechaNews')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
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
                                @elseif(!is_null($imagePost))
                                    <img class="img-fluid img-thumbnail rounded" src="{{asset($imagePost)}}">
                                @endif
                            </div>
                        </div>

                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_news({{$postSelected}})"  wire:loading.attr="disabled" wire:target="update_location, image"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$postSelected}})" wire:loading.attr="disabled"  wire:target="destroy"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store, image"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store, update_location, image, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
