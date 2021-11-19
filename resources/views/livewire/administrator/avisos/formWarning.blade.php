<div class="row">
    <div class="col-md-6">
        @if (auth()->user()->rol == 'Super-Administrador')
            <div class="form-group">
                @php($label = true)
                @php($ModelName = 'instanceSelected')
                @include('livewire.partial.comboInstancias')
            </div>
        @endif

        <div class="form-group">
            <label>Estado: </label>
            <select class="form-control" wire:model="warning_state">
                @foreach($listStates as $sta)
                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="formGroupAsunto">Asunto:</label>
            <input type="text" class="form-control @error('asunto') is-invalid @enderror" id="formGroupAsunto" wire:model.defer="asunto">
            @error('asunto')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

            <div class="form-group">
                <label for="formControlDescription">Descripción:</label>
                <textarea class="form-control" id="formControlDescription" rows="5" wire:model.defer="description"></textarea>
            </div>
    </div>

    <div class="col-md-6">
        @if ($warning_category)
            <div class="form-group">
                <label>Categorías: <span wire:loading.delay wire:target="instanceSelected"><i class="fas fa-spinner fa-spin"></i></span></label>
                <select class="form-control @error('warningCategorySelected') is-invalid @enderror" wire:model="warningCategorySelected">
                    <option value="">-- Categorías --</option>
                    @foreach($warning_category as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif


        @if (!is_null($warning_sub_category))
            <div class="form-group">
                <label>Sub - categoría: <span wire:loading.delay wire:target="warningCategorySelected"><i class="fas fa-spinner fa-spin"></i></span></label>
                <select class="form-control @error('warningSubCategorySelected') is-invalid @enderror" wire:model="warningSubCategorySelected">
                    @foreach($warning_sub_category as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif

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
                @elseif(!is_null($imageWarning))
                    <img class="img-fluid img-thumbnail rounded" src="{{asset($imageWarning)}}">
                @endif
            </div>
            <div class="form-group">
                <label><i class="fas fa-map-pin"></i> <span class="font-weight-bold">Geolocalización:</span> </label>
                @include('component.mapGoogle')
            </div>

    </div>
</div>
