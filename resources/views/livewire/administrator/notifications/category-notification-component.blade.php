<div class="col-md-12">
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?7:10}}">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        @if (auth()->user()->rol =='Super-Administrador')
            <div class="form-group col-md-3">
                @php($label = false)
                @php($ModelName = 'instance_id')
                @include('livewire.partial.comboInstancias')

            </div>
        @endif


        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormBusiness" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>
    <hr>
</div>
