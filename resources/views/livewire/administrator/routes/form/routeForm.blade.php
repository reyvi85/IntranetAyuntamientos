<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-map-signs"></i> {{$titulo}}</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control @error($name) is-invalid @enderror" id="{{$name}}" wire:model.defer="{{$name}}">
            @error($name)
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Dirección:</label>
            <input type="text" class="form-control @error($address) is-invalid @enderror" id="{{$address}}" wire:model.defer="{{$address}}">
            @error($address)
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control @error($description) is-invalid @enderror" id="{{$description}}" wire:model.defer="{{$description}}" rows="2"></textarea>
            @error($description)
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-row">
            <div class="col-md-3">
                <div class="form-group text-center">
                    <div class="text-center text-muted align-middle" wire:loading.grid wire:target="{{$name}}_ruta_imagen">
                        <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
                    </div>

                    @if ($imagen)
                        <img class="img-fluid img-thumbnail rounded" src="{{ $imagen->temporaryUrl() }}">
                    @elseif(!is_null($imagenSelected))
                        <img class="img-fluid img-thumbnail rounded"  src="{{asset($imagenSelected)}}">
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label>Imagen principal:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error($name.'_ruta_imagen') is-invalid @enderror" id="{{$name}}_ruta_imagen" lang="es" wire:model="{{$name}}_ruta_imagen" accept=".png, .jpg, .jpeg">
                        <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                        @error($name.'_ruta_imagen')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
