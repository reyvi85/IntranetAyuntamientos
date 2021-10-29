<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas {{$modalConfig['icon']}}"></i> {{$modalConfig['titulo']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('modalModeDestroy', false)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($modalModeDestroy)
                    <h3 class="text-center"> Confirma realmente que desea eliminar el usuario<br> <span class="text-danger font-weight-bolder">{{$name}}</span>?</h3>
                @else
                    <div class="form-group">
                        <label for="name">Nombre y apellidos:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>


                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control @error('rol') is-invalid @enderror" wire:model.defer="rol">
                                <option value="">-- Roles --</option>
                                @foreach($listRoles as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                            @error('rol')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                    </div>

                    <div class="form-row">
                        <div class="col-md-8 form-group">
                            <label for="password">Password:</label>
                                @if ($formUpdate)
                                    <small class="form-text text-muted text-right">Rellenar solo si desea cambiar la contraseña!</small>
                                @endif
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 align-self-end d-flex align-items-start">
                            <button class="btn btn-primary btn-block" wire:click="generateNewPass" wire:loading.attr="disabled"><i class="fas fa-spinner fa-spin" wire:loading wire:target="generateNewPass"></i> Generar</button>
                        </div>
                    </div>
                    @include('livewire.partial.comboInstancias')
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$set('modalModeDestroy', false)"><i class="fas fa-minus-circle"></i> Cancelar</button>
                @switch($modalConfig['action'])
                    @case('edit')
                    <button type="button" class="btn btn-primary" wire:click="updateUser({{$userSelected}})"  wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Editar</button>
                    @break

                    @case('trash')
                    <button type="button" class="btn btn-danger" wire:click="destroy({{$userSelected}})" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Sí, eliminar</button>
                    @break

                    @default
                    <button type="button" class="btn btn-primary" wire:click="store" wire:loading.attr="disabled"><i class="fas {{$modalConfig['icon']}}"></i> Añadir</button>
                @endswitch
                <div class="text-center text-muted" wire:loading wire:target="store"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>
