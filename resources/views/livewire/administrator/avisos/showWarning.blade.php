@php($data = $avisos->where('id', $warnigSelected)->first())

<h4 class="text-muted"><span class="font-weight-bold text-uppercase">Asunto: </span>{{$data->asunto}}</h4>
<p><span class="font-weight-bold text-uppercase">Descripción: </span>{{$data->description}}</p>
<p><span class="font-weight-bold text-uppercase">Categoría: </span>{{$data->warning_sub_category->warning_category->name}}<br>
    <span class="font-weight-bold text-uppercase">Sub - categoría: </span> {{$data->warning_sub_category->name}}</p>