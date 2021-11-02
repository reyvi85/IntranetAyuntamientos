<div class="col-md-12 mt-4">
    @if ($notifications->count())
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Notificaciones</th>
                <th scope="col">Categoría</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $item)
                {{dd($item)}}
            <tr>
                <td>{{$item->titulo}}</td>
                <td>{{$item->category_notification->name}}</td>
                <td>@mdo</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-center text-muted">No hat registros que mostrar!</p>
    @endif
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$notifications ->links()}}
        </div>
    </div>

</div>
