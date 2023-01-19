<div class="col-md-12 mt-4">
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormCategory" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>
    <hr>
    @if ($listCategory->count())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" wire:click="order('name')">Nombre</th>
                    <th class="text-center" scope="col" wire:click="order('routes_count')">Notificaciones</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listCategory as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td class="text-center">{{$item->routes_count}}</td>
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

    @include('livewire.administrator.routes.formModalCategory')

</div>

@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormCategory').modal('hide');
        });
    </script>
@endsection
