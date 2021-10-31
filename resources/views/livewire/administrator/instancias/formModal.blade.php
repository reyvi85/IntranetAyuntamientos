<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalInstancia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h3 class="text-center"> Confirma realmente que desea eliminar la instancia<br> <span class="text-danger font-weight-bolder">{{$name}}</span>?</h3>
                @else
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nombre de la instancia:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" wire:model="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Comunidades:</label>
                            <select class="form-control @error('selectedCommunity') is-invalid @enderror" wire:model="selectedCommunity">
                                <option value="">-- Comunidades --</option>
                                @foreach($comunidades as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('selectedCommunity')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        @if (!is_null($provincias))
                            <div class="col-md-6 form-group">
                                <label>Provincias:</label>
                                <select class="form-control @error('selectedProvince') is-invalid @enderror" wire:model="selectedProvince">
                                    <option value="">-- Provincias --</option>
                                    @foreach($provincias as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('selectedProvince')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="Municipio">Municipio:</label>
                            <input type="text" class="form-control @error('municipio') is-invalid @enderror" id="Municipio" wire:model="municipio">
                            @error('municipio')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="Barrio">Barrio:</label>
                            <input type="text" class="form-control @error('barrio') is-invalid @enderror" id="Barrio" wire:model="barrio">
                            @error('barrio')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="Barrio">Código postal:</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="Barrio" wire:model="postal_code">
                            @error('postal_code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                   <div class="form-row">
                       <div class="form-group col-md-9">
                           <label for="key">Key Token:</label>
                           <input type="text" class="form-control @error('key') is-invalid @enderror" id="keyToken" wire:model="key">
                           @error('key')
                           <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                           @enderror
                       </div>

                       <div class="form-group col-md-3 align-self-end">
                           <button class="btn btn-primary btn-block" wire:click="generateNewToken" wire:loading.attr="disabled"><i class="fas fa-spinner fa-spin" wire:loading wire:target="generateNewToken"></i> Generar token</button>
                       </div>
                   </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-uppercase"><i class="fas fa-key"></i> Acceso a Módulos:</label>
                        @foreach ($listaModulos as $key=>$mod)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="modulos.{{$mod['id']}}" value="{{$mod['id']}}" id="CheckPermission-{{$key}}">
                                <label class="form-check-label" for="CheckPermission-{{$key}}">
                                    {{$mod['modulo']}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$set('modalModeDestroy', false)"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="updateInstance({{$instanceSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$instanceSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="storeInstance" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="storeInstance"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
