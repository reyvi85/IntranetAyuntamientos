<div class="col-md-12 mt-4">
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?7:10}}">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        @if (auth()->user()->rol =='Super-Administrador')
            <div class="form-group col-md-3">
                @php($label = false)
                @php($ModelName = 'instancias')
                @include('livewire.partial.comboInstancias')

            </div>
        @endif


        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormCategory" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>
    <hr>
    @if ($listCategoryNotification->count())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listCategoryNotification as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td class="float-lg-right">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="edit({{$item->id}})" title="Editar comercio"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormCategory" wire:click="trash({{$item->id}})" title="Eliminar comercio"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted">No hay registros que mostrar!</p>
    @endif


    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$listCategoryNotification ->links()}}
        </div>
    </div>

    @include('livewire.administrator.notifications.formModalCategory')

</div>

@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormCategory').modal('hide');
            $('#nav-tabContent a[href="#nav-category"]').tab('show')
        });
    </script>
@endsection
