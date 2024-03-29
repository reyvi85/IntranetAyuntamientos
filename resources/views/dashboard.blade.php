@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-12">
        @component('component.card')
            @slot('titulo')Dashboard @endslot

            @if (auth()->user()->rol =='Super-Administrador')
                    <form class="row " method="get">
                        <div class="col-md-8">
                            <select class="form-control" name="instancia">
                                <option value="">-- Instancias --</option>
                                @foreach($listInstance as $int)
                                    <option value="{{$int->id}}" {{(request()->instancia == $int->id)?'selected':''}}>{{$int->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i> Filtrar</button>
                        </div>
                    </form>
            @endif
            <hr>
                <div class="row">
                <div class="col-md-6">
                    {!! $warningsTotalChart->container() !!}
                </div>

                <div class="col-md-6">
                    {!! $statiscWarningChart->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {!! $statiscUsersTotalChart->container() !!}
                </div>

                <div class="col-md-6">
                    {!! $statiscUsersPerMonthChart->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    @include('dashboard.dataPost')
                </div>

                <div class="col-md-4">
                    @include('dashboard.dataLocations')
                </div>

                <div class="col-md-4">
                    @include('dashboard.dataBusines')
                </div>
            </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        @include('dashboard.dataEvents')
                    </div>

                    <div class="col-md-4">
                        @include('dashboard.dataRoutes')
                    </div>
                </div>

        @endcomponent
    </div>
@endsection
@section('scripts')
    <script src="{{ $warningsTotalChart->cdn() }}"></script>
    {{ $warningsTotalChart->script() }}
    {{ $statiscWarningChart->script() }}
    {{ $statiscUsersTotalChart->script() }}
    {{ $statiscUsersPerMonthChart->script() }}
@endsection


