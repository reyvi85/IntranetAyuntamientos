<div class="row">
    <div class="col-md-8">
        @include('component.loading')
        @if($listaRoutes->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($listaRoutes as $row)
                <tr>
                    <td scope="row" class="align-middle"><img class="img-fluid img-thumbnail" src="{{asset($row->image)}}" width="100px"></td>
                    <td class="text-left  align-middle">{{$row->name}}</td>
                    <td class="align-middle">{{$row->address}}</td>
                    <td class="align-middle">{{$row->description}}</td>
                    <td class="align-middle">
                        <a href="javascript:void(0)" wire:click="edit({{$row->id}})" title="Editar Ruta intermedias"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)"  wire:click="destroy({{$row->id}})" title="Eliminar"><i class="fas fa-trash"></i></a>
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
    <div class="col-md-4">
        @if($listaRoutes->count() <= $numRouteAllowed || $edit ==true)
        @include('livewire.administrator.routes.form.routeForm',
                 [
                     'titulo'=>'Crear puntos intermedios',
                     'name'=>'ruta_name',
                     'address'=>'ruta_direccion',
                     'description'=>'ruta_description',
                     'nameFieldImagen'=>'ruta_imagen',
                     'imagen'=>$ruta_imagen,
                     'imagenSelected'=>$ruta_imagenSelected
                 ])
        @endif

        @if(!$edit)
            @if($listaRoutes->count() <= $numRouteAllowed)
                <button class="btn btn-primary btn-block mt-2" wire:click="store"><i class="fas fa-plus-circle"></i> Añadir nueva ruta intermedia</button>
            @else
                <p class="text-center text-muted">No se puede crear un nuevo punto intermedio porque cada ruta solo puede tener {{$numRouteAllowed}} punto(s) intermedios!</p>
            @endif
        @else
            <button class="btn btn-primary btn-block mt-2" wire:click="udptRouteIntermediate({{$routeSelected}})"><i class="fas fa-edit"></i> Editar ruta intermedia</button>
        @endif
    </div>

    </div>
