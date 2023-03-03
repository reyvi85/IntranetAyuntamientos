<p>Estimad@, <b>{{$data->user->name}}</b></p>
<p>Su reserva ha sido <b>Confirmada</b> para la fecha <b>{{$data->fecha_reserva}}</b> para <b>{{$data->num_person}} personas</b>.</p>
<p>La ruta seleccionada es: <b>{{$data->route->name}}, </b> la cual comienza <b>{{$data->route->inicio_ruta_name}}</b>
    y su precio es de <b>{{$data->route->price * $data->num_person}} euros!</b></p>
