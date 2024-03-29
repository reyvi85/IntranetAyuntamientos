<div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
        @foreach($listBusiness as $item)
            <tr>
                <th class="w-25">
                    <img src="{{asset((is_null($item->logo) || empty($item->logo))?'images/no-image.jpg':$item->logo)}}" class="img-thumbnail">
                </th>
                <td>
                    <h4 class="h4"><a href="{{$item->url_web}}" target="_blank">{{$item->name}}</a></h4>
                    <p>
                        <span class="font-weight-bold">Descripción:</span> {{$item->description}}<br>
                        <i class="fas fa-bookmark"></i> {{$item->category_busine->name}} <br>
                        @if (!empty($item->telefono))
                            <i class="fas fa-phone"></i> <a href="tel:{{$item->telefono}}">{{$item->telefono}}</a> &nbsp;
                        @endif
                        @if (!empty($item->email))
                            <i class="fas fa-envelope"></i> <a href="mailto:{{$item->email}}">{{$item->email}}</a> <br>
                        @endif
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
