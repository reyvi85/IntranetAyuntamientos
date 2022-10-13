@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fas fa-cogs"></i> {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif
                        @if ($optMenu->count())
                            @php($aux = 0)
                                @foreach($optMenu as $item)
                                    @php($aux ++)
                                @if ($aux%4 == 1)
                                    <div class="row py-2">
                                @endif
                                    <div class="col-md-3 py-2">
                                        <div class="card">
                                            <a href="{{route($item['routeName'])}}">
                                            <img src="{{asset('images/'.$item['imagen'])}}" class="card-img-top" alt="{{$item['modulo']}}">
                                            <div class="card-body">
                                                <h5 class="card-title text-center font-weight-bold">{{$item['modulo']}}</h5>
                                                <!-- <p class="card-text text-center"><i class="fas {{$item['icon']}} fa-4x"></i></p> -->
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                @if ($aux%4 == 0)
                                    </div>
                                @endif
                                @endforeach
                            </ul>
                        @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
