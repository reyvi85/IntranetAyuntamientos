<div>
    <div class="col-md-6">
        {!! $chart->container() !!}
    </div>
</div>

@section('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
