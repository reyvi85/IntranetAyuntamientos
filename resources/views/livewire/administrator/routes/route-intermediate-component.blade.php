<div>
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
    <hr>
    <div class="overflow-auto">
        {{$listaRoutes->count()}}
    </div>
</div>
