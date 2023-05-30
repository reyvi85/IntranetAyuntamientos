@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-12">
        @component('component.card')
            @slot('titulo')Dashboard @endslot
            <div class="row">
                <div class="col-md-12">
                    {!! $warningsTotalChart->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! $statiscWarningChart->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! $statiscUsersTotalChart->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! $statiscUsersPerMonthChart->container() !!}
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


