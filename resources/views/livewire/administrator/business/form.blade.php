<div class="form-group">
    <label for="formGroupExampleInput">Nombre:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" wire:model="name">
    @error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="formGroupDireccion">Dirección:</label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="formGroupDireccion" wire:model="direccion">
        @error('direccion')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="formGroupPhone">Teléfonos:</label>
        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="formGroupPhone" wire:model="telefono">
        @error('telefono')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="formGroupFaxs">Faxs:</label>
        <input type="text" class="form-control @error('fax') is-invalid @enderror" id="formGroupFaxs" wire:model="fax">
        @error('fax')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="formGroupEmail">Email:</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="formGroupEmail" wire:model="email">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="formGroupWeb">Url Web:</label>
        <input type="text" class="form-control @error('urlWeb') is-invalid @enderror" id="formGroupWeb" wire:model="urlWeb" placeholder="http://www.">
        @error('urlWeb')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Instancias:</label>
        <select class="form-control @error('instance_busine') is-invalid @enderror" wire:model="instance_busine">
            <option value="">-- Instancias --</option>
            @foreach($listInstances as $int)
                <option value="{{$int->id}}">{{$int->name}}</option>
            @endforeach
            @error('instance_busine')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Categorías:</label>
        <select class="form-control @error('category_busine') is-invalid @enderror" wire:model="category_busine">
            <option value="">-- Categorías --</option>
            @foreach($listCategoryBusiness as $ctg)
                <option value="{{$ctg->id}}">{{$ctg->name}}</option>
            @endforeach
        </select>
        @error('category_busine')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>



<div class="row">
    <div class="col-md-8">
        <label for="exampleFormControlTextarea1">Descripción:</label>
        <textarea class="form-control" id="basic-example" rows="8" wire:model="description"></textarea>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Logo:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFileLang-{{$indentificadorLogo}}" lang="es" wire:model="logo">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>
        </div>
        <div class="form-group text-center">
            <div class="text-center text-muted align-middle" wire:loading wire:target="logo">
                <i class="fas fa-spinner fa-spin"></i> Cargando imagen ...
            </div>

            @if ($logo)
                <img class="img-fluid img-thumbnail rounded" src="{{ $logo->temporaryUrl() }}">
            @endif
        </div>
        </div>
</div>
