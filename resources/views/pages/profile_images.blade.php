@extends('layouts.app')

@section('title')Imagens de {{ $user->name.' '.$user->last_name }} @endsection

@section('description')Gostou das imagens de {{ $user->name.' '.$user->last_name }} ? Cadastre-se agora e publique as suas também! @endsection

@section('content')
    <div class="row">
        <div class="col l12 s12 m12">
            @include('components.my_info')
        </div>
    </div>
    <div class="row">
        <div class="col l8 s12 m12">
            <div class="card-panel">
                <div class="carousel">
                    @foreach($images as $image)
                        <a href="{{ asset('/storage/images/'.$image->name) }}" class="carousel-item" data-lightbox="myimage">
                            <img src="{{ asset('/storage/images/'.$image->name) }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col l4 hide-on-med-and-down">
            <div class="card-panel">
                propagandas
            </div>
        </div>
    </div>
@endsection