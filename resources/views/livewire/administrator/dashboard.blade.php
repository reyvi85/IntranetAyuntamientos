@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Dashboard @endslot
        <div class="row">
            <div class="col-md-12">
                @livewire('dashboard.avisos-component')
            </div>
        </div>
    @endcomponent
</div>
@endsection

