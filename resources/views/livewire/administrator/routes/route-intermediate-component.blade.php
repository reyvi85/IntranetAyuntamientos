<div class="row">
    <div class="col-md-8">
        <div class="">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">fgd</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listaRoutes as $row)
                <tr>
                    <td><img class="img-fluid w-25 img-thumbnail rounded" src="{{asset($row->image)}}"></td>
                    <td class="text-left"><p class="h5">{{$row->name}}</p>
                        <small class="text-lowercase"><i class="fas fa-map-marker-alt"></i> {{$row->address}}<br>
                            {{$row->description}}
                        </small>
                    </td>
                    <td><i class="fas fa-trash"></i> Eliminar</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
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
        <button class="btn btn-primary btn-block mt-2" wire:click="store"><i class="fas fa-plus-circle"></i> Añadir nueva ruta intermedia</button>
    </div>

    </div>
