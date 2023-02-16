<div class="container">
    <div class="row align-items-start">
        <div class="col-md-2 align-middle"><img src="{{asset($route->inicio_ruta_imagen)}}" class="rounded-circle img-thumbnail"></div>
        <div class="col-md-10">
            <h4>{{$route->inicio_ruta_name}}</h4>
            <p class="text-muted">{{$route->inicio_ruta_description}}</p>
            <p class="small text-muted"><i class="fas fa-address-card"></i> {{$route->inicio_ruta_direccion}}</p>
        </div>
    </div>
<hr>
    @foreach($route->route_intermediates as $item)
        <div class="row align-items-start">
            <div class="col-md-2 align-bottom"></div>
            <div class="col-md-2 align-middle"><img src="{{asset($item->image)}}" class="rounded-circle img-thumbnail"></div>
            <div class="col-md-8">
                <h5>{{$item->name}}</h5>
                <p class="text-muted">{{$item->description}}</p>
                <p class="small text-muted"><i class="fas fa-address-card"></i> {{$item->address}}</p>
            </div>
        </div>
        <hr>
    @endforeach
    <div class="row align-items-end">
        <div class="col-md-2 align-middle"><img src="{{asset($route->fin_ruta_imagen)}}" class="rounded-circle img-thumbnail"></div>
        <div class="col-md-10">
            <h4>{{$route->fin_ruta_name}}</h4>
            <p class="text-muted">{{$route->fin_ruta_description}}</p>
            <p class="small text-muted"><i class="fas fa-address-card"></i> {{$route->fin_ruta_direccion}}</p>
        </div>
    </div>
</div>
