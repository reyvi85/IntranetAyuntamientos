<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-info-circle"></i> Información General</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            @php($label = true)
            @php($ModelName = 'instanceSelected')
            @include('livewire.partial.comboInstancias')
        </div>
        @if ($listCategory->count())
            <div class="form-group ">
                <select class="form-control @error('categorySelected') is-invalid @enderror"  wire:model="categorySelected">
                    <option value="">-- Categorías --</option>
                    @foreach($listCategory as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
                @error('categorySelected')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        @endif

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
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


        <div class="form-group">
            <label for="web">Precio:</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" id="web" wire:model.defer="price" placeholder="0.00" aria-describedby="priceHelp">
            <div id="priceHelp" class="form-text small">Dejar vacío si la ruta es gratis!</div>
            @error('price')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Imagen principal:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror" id="customFileLang" lang="es" wire:model="imagen" accept=".png, .jpg, .jpeg">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                @error('imagen')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="form-group text-center">
            <div class="text-center text-muted align-middle" wire:loading.grid wire:target="imagen">
                <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
            </div>

            @if ($imagen)
                <img class="img-fluid img-thumbnail rounded" src="{{ $imagen->temporaryUrl() }}">
            @elseif(!is_null($imageRoute))
                <img class="img-fluid img-thumbnail rounded" src="{{asset($imageRoute)}}">
            @endif
        </div>
    </div>
</div>

