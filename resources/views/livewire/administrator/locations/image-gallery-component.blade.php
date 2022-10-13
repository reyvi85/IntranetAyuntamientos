    <div class="col-md-12">
        <h5><i class="fas fa-images"></i> Galería de imagenes</h5>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('imageGallery') is-invalid @enderror" id="customFileLang" lang="es" wire:model="imageGallery" multiple>
            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            @error('imageGallery.*')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group text-center">
            <div class="text-center text-muted align-middle" wire:loading.grid wire:target="imageGallery, destroyImageGalery">
                <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
            </div>
        </div>

        @if ($imageGallery)
            <div class="d-flex flex-row bd-highlight mb-3">
                @foreach($imageGallery as $img)
                    <div class="p-2 bd-highlight">
                        <img class="img-thumbnail" src="{{ $img->temporaryUrl() }}">
                    </div>
                @endforeach
            </div>
        @elseif(!is_null($locationSelected))
            <div class="d-flex flex-row bd-highlight mb-3">
                @foreach($locationSelected->gallery as $img)
                    <div class="p-2 bd-highlight">
                        <img class="img-thumbnail" src="{{ asset($img->image) }}">
                        <p class="text-center mt-2"><a href="javascript:void (0)"><i class="fas fa-trash fa-2x" title="Eliminar imagen" wire:click="destroyImageGalery({{$img->id}})"></i></a></p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

