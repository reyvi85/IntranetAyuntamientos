@if ($modalModeShow)
    @php($data = $avisos->where('id', $warnigSelected)->first())
    <h3 class="text-right text-muted"><span class="font-weight-bold text-uppercase">Estado:</span> <span class="badge badge-pill badge-{{$data->warning_state->color}}">&nbsp;{{$data->warning_state->name}}</span></h3>
    <h4 class="text-muted"><span class="font-weight-bold text-uppercase">Asunto: </span>{{$data->asunto}}</h4>
    <p><span class="font-weight-bold text-uppercase">Descripción: </span>{{$data->description}}</p>
    <p><span class="font-weight-bold text-uppercase">Categoría: </span>{{$data->warning_sub_category->warning_category->name}}<br>
        <span class="font-weight-bold text-uppercase">Sub - categoría: </span> {{$data->warning_sub_category->name}}</p>
    <p><span class="font-weight-bold text-uppercase">Ubicación: </span>{{$data->ubicacion}}</p>
    <div class="row">
        <div class="col-md-6">
            <h5><i class="fas fa-map-marker-alt"></i> Geolocalización</h5>
            <div id="map" style="height: 400px; width: 100%;" wire:ignore></div>
        </div>
        <div class="col-md-6 align-middle">
            <h5><i class="fas fa-image"></i> Imagen</h5>
            @if(is_null($data->image) || $data->image=="")
                <img class="img-fluid img-thumbnail rounded" src="{{asset('images/no-image.png')}}" alt="Sin imagen">
            @elseif(!is_null($data->image))
                <img class="img-fluid img-thumbnail rounded" src="{{asset($data->image)}}">
            @endif
        </div>
    </div>
    <hr>
    @if ($data->warning_answers->count())
        <div class="vertical-Scroll">
            <h4 class="text-center text-muted">RESPUESTAS ENVIADAS.</h4>
            @foreach($data->warning_answers as $asw)
                <p>
                    <span class="float-right font-weight-bold">{{$asw->created_at}}</span><br>
                    {{$asw->answer}}
                </p>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No se ha enviado nunguna respuesta!</p>
    @endif
@endif
