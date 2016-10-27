@extends('layouts.app')

@section('title')Perfil de {{ $user->name.' '.$user->last_name }} @endsection

@section('description'){{ $user->name.' '.$user->last_name }} se cadastrou no XFind, cadastre-se você também e fique por dentro de tudoo que esta pessoa está fazendo. @endsection

@section('content')
    <div class="row">
        <div class="col l12 s12 m12">
            @include('components.my_info')
        </div>
    </div>
    <div class="row">
        <div class="col l8 s12 m12">
            <div class="card-panel">
                @include('components.feeds-form')
            </div>
        </div>
        <div class="col l4 hide-on-med-and-down">
            <div class="card-panel">
                propagandas
            </div>
        </div>
    </div>
@endsection