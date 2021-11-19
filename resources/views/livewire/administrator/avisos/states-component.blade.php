<div class="row mt-4">
    <div class="col-md-12">
        @include('component.loading')
        <div class="col-md-12 d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalState" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir estado</button>
        </div>
        @if($listStates->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Estado</th>
                    <th scope="col" class="text-center">Color</th>
                    <th class="text-center" scope="col">Avisos</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listStates as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td class="text-center"><h4><span class="badge badge-pill badge-{{$row->color}}">&nbsp;</span></h4></td>
                        <td class="text-center">{{$row->warnings_count}}</td>
                        <td class="text-right">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalState" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalState" wire:click="trash({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            @else
        <p class="text-center text-muted">No hay registros que mostrar!</p>
            @endif
    </div>
    @include('livewire.administrator.avisos.formModalState')
</div>


