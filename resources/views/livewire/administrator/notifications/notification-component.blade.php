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
                <select class="form-control" wire:model="categorySelected">
                    <option value="">-- Categorías --</option>
                    @foreach($listCategory as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormCategory" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>

    <hr>
    @if ($notifications->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Notificaciones</th>
                <th scope="col">Categoría</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $item)
            <tr>
                <td>{{$item->titulo}}</td>
                <td>{{$item->category_notification->name}}</td>
                <td></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-center text-muted">No hat registros que mostrar!</p>
    @endif
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$notifications ->links()}}
        </div>
    </div>

</div>
