@php($aux = 0)
@foreach($listBusiness as $item)
    @php($aux++)
        @if ($aux %3 == 1)
            <div class="row py-2">
        @endif
            <div class="col-md-4 pt-2">
                <div class="card">
                    <img class="card-img-top" src="{{asset((is_null($item->logo) || empty($item->logo))?'images/no-image.jpg':$item->logo)}}" alt="{{$item->name}}"  title="{{$item->name}}" width="100%" height="248px">
                    <div class="card-body">
                        @if (!empty($item->url_web))
                        <h5 class="card-title"><a href="{{$item->url_web}}" target="_blank">{{$item->name}}</a></h5>
                        @else
                            <h5 class="card-title">{{$item->name}}</h5>
                        @endif
                        <p class="card-text"><span class="font-weight-bold">Descripción:</span> {{$item->description}}<br><br>
                        <i class="fas fa-address-card"></i> <span class="font-weight-bold">Dirección:</span> {{$item->direccion}}<br>
                            <i class="fas fa-bookmark" title="Categoría"></i> {{$item->category_busine->name}} <br>
                            @if (!empty($item->telefono))
                                <i class="fas fa-phone"></i> <a href="tel:{{$item->telefono}}">{{$item->telefono}}</a> &nbsp;
                            @endif
                            @if (!empty($item->email))
                                <i class="fas fa-envelope"></i> <a href="mailto:{{$item->email}}">{{$item->email}}</a> <br>
                            @endif
                        </p>

                    </div>
                </div>
            </div>
        @if ($aux %3 == 0)
             </div>
        @endif
@endforeach
