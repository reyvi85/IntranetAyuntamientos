<div class="form-row">
    <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?4:7}}">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    @if (auth()->user()->rol =='Super-Administrador')
        <div class="form-group col-md-3">
            @php($label = false)
            @php($ModelName = 'instancias')
            @include('livewire.partial.comboInstancias')

        </div>
    @endif

    <div class="form-group col-md-3">
        <input type="text" class="form-control" id="filterFecha" name="fechaFilter" placeholder="Rango de fecha..." wire:model="fechaFilter">
    </div>

    <div class="form-group col-md-2">
        <button class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Añadir</button>
    </div>



</div>
