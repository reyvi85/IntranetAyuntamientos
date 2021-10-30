<div class="form-group">
    <label for="formGroupExampleInput">Nombre:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" wire:model.defer="name">
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="formGroupDireccion">Dirección:</label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="formGroupDireccion" wire:model.defer="direccion">
        @error('direccion')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="formGroupPhone">Teléfono:</label>
        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="formGroupPhone" wire:model.defer="telefono">
        @error('telefono')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="formGroupEmail">Email:</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="formGroupEmail" wire:model.defer="email">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="formGroupWeb">Url Web:</label>
        <input type="text" class="form-control @error('urlWeb') is-invalid @enderror" id="formGroupWeb" wire:model.defer="urlWeb" placeholder="http://www.">
        @error('urlWeb')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    @if (auth()->user()->rol == 'Super-Administrador')
        <div class="form-group col-md-6">
            @php($label = true)
            @php($ModelName = 'instanceSelected')
            @include('livewire.partial.comboInstancias')
        </div>
    @endif

    <div class="form-group col-md-6">
        <label>Categorías:</label>
        <select class="form-control @error('category_busine') is-invalid @enderror" wire:model.defer="category_busine">
            <option value="">-- Categorías --</option>
            @foreach($listCategoryBusiness as $ctg)
                <option value="{{$ctg->id}}">{{$ctg->name}}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="row">
    <div class="col-md-8">
        <label for="exampleFormControlTextarea1">Descripción:</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="basic-example" rows="10" wire:model.defer="description"></textarea>
        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Logo:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" id="customFileLang-{{$indentificadorLogo}}" lang="es" wire:model="logo">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                @error('logo')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="form-group text-center">
            <div class="text-center text-muted align-middle" wire:loading wire:target="logo">
                <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
            </div>

            @if ($logo)
                <img class="img-fluid img-thumbnail rounded" src="{{ $logo->temporaryUrl() }}">
                @elseif(!is_null($imgBussines))
                <img class="img-fluid img-thumbnail rounded" src="{{asset($imgBussines)}}">
            @endif
        </div>
        </div>
</div>
