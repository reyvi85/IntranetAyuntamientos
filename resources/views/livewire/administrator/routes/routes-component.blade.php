<div class="col-md-12 mt-4">
    @include('component.loading')
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

        @if ($listCategory->count())
            <div class="form-group col-md-3">
                <select class="form-control" wire:model="categoryFilter">
                    <option value="">-- Categorías --</option>
                    @foreach($listCategory as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormRoutes" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>
    <hr>
   @include('livewire.administrator.routes.listRoutes')
    @include('livewire.administrator.routes.formModalRoute')
</div>


