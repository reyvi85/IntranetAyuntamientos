@extends('layouts.appPublic')
@section('title', 'Eliminar suscripción')
@section('content')

<h1>Eliminar subscripción</h1>
    <p class="text-muted"> Estás a punto de darse de baja de nuestros servicios y eliminar todos los datos asociados al mismo.</p>
    <p>

    @if(session('message'))
        <div class="alert alert-success">
            {!! session('message') !!}
        </div>
    @else
    <form class="form-group" action="{{ route('unsubscribe.done') }}" method="POST">
    @csrf
    <!-- nuestro formulario -->
        <label for="email5" class="form-label">Email</label>
        <input type="text" name="email" id="email5" class="form-control @error('email') is-invalid @enderror" placeholder="user@domain.com">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        <div class="form-group py-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-minus-circle"></i> Eliminar subscripción</button>
        </div>
    </form>
    </p>
    @endif

@endsection
