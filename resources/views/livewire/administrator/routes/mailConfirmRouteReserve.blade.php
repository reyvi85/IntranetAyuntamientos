<p>Estimad@, <b>{{$data->user->name}}</b></p>
<p>Su reserva ha sido <b>Confirmada</b> para la fecha <b>{{$data->fecha_reserva}}</b>.</p>
<p>La ruta seleccionada es: <b>{{$data->route->name}}, </b> la cual contiene <b>{{$data->route->route_intermediates->count()}} puntos intermedios</b>
    y su precio es de <b>{{$data->route->price}} euros!</b></p>
