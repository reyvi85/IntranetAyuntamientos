<div>
    @foreach($listBusiness as $item)
        <p>{{$item->name}}</p>
        @endforeach

    <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
                    {{$listBusiness->links()}}
            </div>
</div>

</div>
