@extends('layouts.app')

@section('title')Logue-se @endsection

@section('description')Logue-se e converse com todos os seus amigos, veja o que eles andam fazendo e conheça novas pessoas @endsection

@section('content')
    <br>
    <div class="row" style="width: 400px">
        <div class="col s12 m12 l12">
            <form class="login-form  z-depth-4 card-panel" method="POST" action="/login" role="form">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="storage/default_images/logo.jpg" alt="" class="circle z-depth-4 responsive-img valign profile-image-login">
                        <p class="center login-form-text">Logue-se Agora!</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mif prefix">perm_identity</i>
                        <input id="email" type="text" name="email">
                        <label for="email">Email</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mif prefix">lock_outline</i>
                        <input id="password" type="password" name="password">
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me" name="remember"/>
                        <label for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="/register">Registre-se Agora!</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection