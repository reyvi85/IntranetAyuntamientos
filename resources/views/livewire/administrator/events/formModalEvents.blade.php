<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormEvents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('modalModeDestroy', false)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($modalModeDestroy)
                    <h3 class="text-center"> Confirma realmente que desea eliminar este evento<br> <span class="text-danger font-weight-bolder">{{$titulo}}</span>?</h3>
                @else
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                @php($label = true)
                                @php($ModelName = 'instanceSelected')
                                @include('livewire.partial.comboInstancias')
                            </div>
                            @if ($listCategory->count())
                                <div class="form-group ">
                                    <select class="form-control" wire:model="categorySelected">
                                        <option value="">-- Categorías --</option>
                                        @foreach($listCategory as $ctg)
                                            <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="name" wire:model.defer="titulo">
                                @error('titulo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model.defer="description" rows="5"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="ubicacion">Fecha inicio:</label>
                                    <input type="text" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" wire:model.defer="fecha_inicio" onchange="this.dispatchEvent(new InputEvent('input'))">
                                    <div class="form-text"><small>YYYY-MM-DD</small></div>
                                    @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="ubicacion">Fecha fin:</label>
                                    <input type="text" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" wire:model.defer="fecha_fin" onchange="this.dispatchEvent(new InputEvent('input'))">
                                    <div class="form-text"><small>YYYY-MM-DD</small></div>
                                    @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="web">Web:</label>
                                <input type="text" class="form-control @error('web') is-invalid @enderror" id="web" wire:model.defer="web" placeholder="http://">
                                @error('web')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Imagen principal:</label>
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
                                        @elseif(!is_null($imageEvent))
                                            <img class="img-fluid img-thumbnail rounded" src="{{asset($imageEvent)}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Geolocalización:</label>
                                    @include('component.mapGoogle')
                                </div>
                            </div>


                            <div class="row mt-3">

                            </div>
                        </div>

                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_event({{$eventSelected}})"  wire:loading.attr="disabled" wire:target="update_event, image"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$eventSelected}})" wire:loading.attr="disabled"  wire:target="destroy"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled" wire:target="store, image"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store, update_event, image, destroy"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
