@extends('layouts.app')
@section('title')Registre-se @endsection
@section('description')Registre-se e econtre amigos, conheça pessoas e fique por dentro de tudo que esta rolando @endsection

@section('content')
    <br>
    <div class="row">
        <div class="col s12 m10 l8 offset-l2 offset-m1">
            <form class="login-form  z-depth-4 card-panel" method="POST" action="{{ url('/register') }}" role="form">
                {{ csrf_field() }}

                @foreach($errors as $error)
                    {{ $error }}
                @endforeach
                <div class="row margin">
                    <div class="input-field col s12 center">
                        <img src="storage/default_images/logo.jpg" alt="" class="circle z-depth-4 responsive-img valign profile-image-login">
                        <p class="center login-form-text">Registre-se Agora e junte-se a comunidade do XFind!</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 m12 l6">
                        <i class="mdi mdi-account-circle prefix"></i>
                        <input id="name" type="text" class="validate" name="name" min="3">
                        <label for="name">Nome</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <span class="mdi mdi-account-box prefix"></span>
                        <input id="last_name" type="text" class="validate" name="last_name" min="3">
                        <label for="last_name">Sobrenome</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 m12 l6">
                        <span class="prefix mdi mdi-lock"></span>
                        <input id="password" type="password" class="validate" name="password" min="8">
                        <label for="password">Senha</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <span class="prefix mdi mdi-lock-outline"></span>
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation"
                               required min="8">
                        <label for="password-confirm">Confirmar Senha</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 m12 l6">
                        <span class="prefix mdi mdi-gender-transgender"></span>
                        <select name="gender" id="gender">
                            <option value="" disabled selected>Sexo</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                            <option value="3">Outros</option>
                        </select>
                    </div>

                    <div class="input-field col s12 m12 l6">
                        <span class="prefix mdi mdi-calendar"></span>
                        <div class="row">
                            <div class="col s4 m4 l4">
                                <select name="bd_day" id="gender" class="margin-left-40">
                                    <option value="" disabled selected>Dia</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col s4 m4 l4">
                                <select name="bd_month" id="gender" class="margin-left-40">
                                    <option value="" disabled selected>Mes</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col s4 m4 l4">
                                <select name="bd_year" id="gender" class="margin-left-40">
                                    <option value="" disabled selected>Ano</option>
                                    @for($i = date('Y'); $i >= 1940; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 m12 l12">
                        <span class="mdi mdi-email prefix"></span>
                        <input type="email" class="validate" id="email" name="email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s4 m4 l6">
                        <button type="submit" class="btn">Registrar</button>
                    </div>
                    <div class="input-field col s8 m8 l6">
                        <p class="margin medium-small">Ja tem uma conta ? <a href="/login">Logue-se Agora!</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>




    {{--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

@endsection
