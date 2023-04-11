<p>Estimad@, <b>{{$data->user->name}}</b></p>
<p>Su reserva ha sido <b>Confirmada</b> para la fecha <b>{{\Carbon\Carbon::parse($data->fecha_reserva)->isoFormat('dddd D \d\e MMMM \d\e\l Y / HH:mm')}}</b> para <b>{{$data->num_person}} personas</b>.</p>
<p>La ruta seleccionada es: <b>{{$data->route->name}}, </b> la cual comienza en <b>{{$data->route->inicio_ruta_name}}</b>
    y su precio es de <b>{{$data->cost}} euros!</b></p>
