<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalFormNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h3 class="text-center"> Confirma realmente que desea eliminar esta notificación<br> <span class="text-danger font-weight-bolder">{{$titulo}}</span>?</h3>
                @else
                    <div class="form-row">
                        @if (auth()->user()->rol =='Super-Administrador')
                            <div class="form-group col-md-6">
                                @php($label = true)
                                @php($ModelName = 'instanceSelected')
                                @include('livewire.partial.comboInstancias')
                            </div>
                        @endif

                            @if ($instanceSelected)
                                <div class="form-group col-md-6">
                                    <label>Categoría:</label>
                                    <select class="form-control  @error('categoryNotification') is-invalid @enderror" wire:model="categoryNotification">
                                        <option value="">-- Categorías --</option>
                                        @foreach($listCategoryAddUdpt as $ctg)
                                            <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryNotification')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            @endif
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="name">Titulo:</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="name" wire:model.defer="titulo">
                            @error('titulo')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4" wire:ignore>
                            <label>Fecha de publicación:</label>
                            <input type="datetime" class="form-control" id="fechaPublicacion" wire:model.defer="fechaPublicacion" onchange="this.dispatchEvent(new InputEvent('input'))">
                            @error('fechaPublicacion')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descripción...." wire:model.defer="description" rows="6"></textarea>
                        @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="update_notification({{$notificationSelected}})"  wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$notificationSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="update_notification, destroy, store"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
