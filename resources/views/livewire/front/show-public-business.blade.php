<div class="col-md-12">
    @include('component.loading')
    @php($aux = 0)
    @foreach($listBusiness as $item)
        @php($aux++)
    @if ($aux %3 == 1)
        <div class="row py-2">
        @endif
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset((is_null($item->logo)?'images/no-imagen.png':$item->logo))}}" alt="{{$item->name}}"  title="{{$item->name}}" width="100%" height="248px">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text"><span class="font-weight-bold">Descripción:</span> {{$item->description}}</p>
                        <p class="card-text"><i class="fas fa-address-card"></i> <span class="font-weight-bold">Dirección:</span> {{$item->direccion}}</p>
                        <p class="card-text"><i class="fas fa-phone"></i> {{$item->telefono}} <br>
                            <i class="fas fa-paper-plane"></i> <a href="mailto:{{$item->email}}">{{$item->email}}</a> <br>
                            <i class="fas fa-globe"></i> <a href="{{$item->url_web}}" target="_blank">{{$item->url_web}}</a>
                        </p>

                    </div>
                </div>
            </div>

        @if ($aux %3 == 0)
            </div>
        @endif

        @endforeach

    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
                {{$listBusiness->links()}}
        </div>
    </div>

</div>
