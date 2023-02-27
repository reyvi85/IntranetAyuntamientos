<p>Estimad@, <b>{{$data->user->name}}</b></p>
<p>Su reserva ha sido <b>Confirmada</b> para la fecha <b>{{$data->fecha_reserva}}</b>
    La ruta seleccionada es: <b>{{$data->route->name}}, </b> la cual contiene {{$data->route->route_intermediates->count()}} puntos intermedios
    y su precio es de {{$data->route->price}} euros!</p>

