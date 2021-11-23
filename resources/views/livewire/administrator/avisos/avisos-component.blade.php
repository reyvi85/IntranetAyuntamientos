<div class="row mt-4">
    <div class="col-md-12">
        @include('component.loading')
    <!---- Filtros --->
        @include('livewire.administrator.avisos.filtros')
            <hr>
            <nav class="nav nav-pills flex-column flex-sm-row mb-2">
                @foreach($listStates as $state)
                    <a class="flex-sm-fill text-sm-center nav-link" href="javascript:void(0)" wire:click="$set('stateSelected', '{{$state->id}}')"><span class="badge badge-pill badge-{{$state->color}}">{{$state->warnings_count}}</span> {{$state->name}}</a>
                @endforeach
                @if (!is_null($stateSelected))
                        <a class="flex-sm-fill text-sm-center nav-link" href="javascript:void(0)" wire:click="$set('stateSelected', null)"><i class="fas fa-filter"></i> Todos</a>
                    @endif
            </nav>
            <hr>
    @if ($avisos->count())
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th class="align-middle link-pointer" scope="col" wire:click="order('id')">#</th>
                    <th class="align-middle link-pointer" scope="col" wire:click="order('warning_state_id')">Estado</th>
                    <th class="align-middle link-pointer" scope="col" wire:click="order('asunto')">Asunto</th>
                    <th class="align-middle" scope="col">
                        Categoría<br>
                        Sub-categoría
                    </th>
                    <th class="align-middle text-center">Respuestas</th>
                    <th class="align-middle link-pointer" scope="col" wire:click="order('created_at')">Fecha</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($avisos as $row)
                    <tr>
                        <th class="align-middle" scope="row">{{$row->id}}</th>
                        <td class="align-middle"><h4><span class="badge badge-pill badge-{{$row->warning_state->color}}">&nbsp;</span></h4></td>
                        <td class="align-middle">{{$row->asunto}}</td>
                        <td class="align-middle">
                            {{$row->warning_sub_category->warning_category->name}}<br>
                            {{$row->warning_sub_category->name}}
                        </td>
                        <td class="align-middle text-center">{{$row->warning_answers_count}}</td>
                        <td class="align-middle">{{date("Y/m/d",strtotime($row->created_at))}}</td>
                        <td class="align-middle">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormWarning" wire:click="edit({{$row->id}})" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalFormWarning" wire:click="trashWarning({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
                        </td>
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
                {{$avisos->links()}}
            </div>
        </div>
    </div>
@include('livewire.administrator.avisos.formModalWarnings')
</div>
