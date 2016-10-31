@extends('layouts.app')

@section('title')Chat @endsection

@section('description')Converse com diversas pessoas e encontre seus amigos nessa primeira versão do XFind @endsection

@section('content')
    @include('components.navbar')
    <xf-chat></xf-chat>
    @include('components.footer')
@endsection