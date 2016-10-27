@extends('layouts.app')

@section('title')Home @endsection

@section('description')Veja tudo que seus amigos estão fazendo, curta e compartilhe, fique por dentro das novidades @endsection

@section('content')
    <div class="row ">
        <div class="col l3 hide-on-med-and-down ">
            <div class="card-panel">
                @include('components.user-info')
            </div>
        </div>
        <div class="col l6 m12 s12">
            <div class="card-panel">
                @include('components.feeds-form')
            </div>
        </div>
        <div class="col l3 hide-on-med-and-down">
            <div class="card-panel">
                @include('components.messages')
            </div>
        </div>
    </div>
    @endsection


@section('script')
    <script>
        var token = '{{ csrf_token() }}';

        $.ajax({
            method:'post',
            url: '/vue/get/posts',
            data: {_token: token}
        }).done(function (res) {
            alert(res);
        });
    </script>
@endsection