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
        <input type="text" class="form-control" id="filterFecha" name="fechaFilter" placeholder="Rango de fecha..." wire:model="fechaFilter">
    </div>

    <div class="form-group col-md-2">
        <select class="form-control" wire:model="categoryFilterSelected">
            <option value="">-- Categorías --</option>
            @foreach($listCategoryFilter as $ctg)
                <option value="{{$ctg->id}}">{{$ctg->name}}</option>
            @endforeach
        </select>
    </div>

    @if ($listSubCategoryFilter->count())
        <div class="form-group col-md-2">
            <select class="form-control" wire:model="subCategoryFilterSelected">
                <option value="">-- Sub - categorías --</option>
                @foreach($listSubCategoryFilter as $ctg)
                    <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                @endforeach
            </select>
        </div>

    @endif


</div>
