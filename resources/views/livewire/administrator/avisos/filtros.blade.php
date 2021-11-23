<div class="form-row">
    <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?3:7}}">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
    </div>

    @if (auth()->user()->rol =='Super-Administrador')
        <div class="form-group col-md-2">
            @php($label = false)
            @php($ModelName = 'instancias')
            @include('livewire.partial.comboInstancias')

        </div>
    @endif

    <div class="form-group col-md-3">
        {{$fechaFilter}}
        <input type="text" class="form-control datepicker" id="filterFecha" placeholder="Rango de fecha..." wire:model="fechaFilter">
    </div>

        <div class="form-group col-md-1">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormWarning" wire:click="add" title="Añadir"><i class="fas fa-plus-circle fa-2x link-pointer align-middle"></i></a>
        </div>
</div>
