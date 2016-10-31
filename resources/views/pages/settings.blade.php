@extends('layouts.app')

@section('title')Configurações @endsection

@section('content')
    @include('components.navbar')
    <br><br>
    <div class="row">
        <div class="col l8 offset-l2 s12 m12">
            <div class="center">
                <h5>Edite suas configurações!</h5>
                <div class="settings">
                    <div class="col l12 s12 m12 card-panel">
                        <div class="row setting_edit">
                            <br>
                            <div class="col s12 m12 l6 input-field">
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
                                <label for="name">Nome</label>
                            </div>
                            <div class="col s12 m12 l6 settings_action input-field">
                                <button type="button" class="btn save_setting">Salvar</button>
                            </div>
                        </div>
                        <div class="row setting_edit">
                            <div class="col s12 m12 l6 input-field">
                                <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}">
                                <label for="last_name">Sobrenome</label>
                            </div>
                            <div class="col s12 m12 l6 settings_action input-field">
                                <button type="button" class="btn save_setting">Salvar</button>
                            </div>
                        </div>
                        <div class="row setting_edit">
                            <div class="col s12 m12 l6 input-field">
                                <input type="text" name="about" id="about" value="{{ Auth::user()->setting->about }}" maxlength="120">
                                <label for="about">Sobre você</label>
                            </div>
                            <div class="col s12 m12 l6 settings_action input-field">
                                <button type="button" class="btn save_setting">Salvar</button>
                            </div>
                        </div>
                        <div class="row setting_edit">
                            <div class="col s12 m12 l6 input-field">
                                <input type="text" name="status" id="status" value="{{ Auth::user()->setting->status }}" maxlength="120">
                                <label for="status">Status</label>
                            </div>
                            <div class="col s12 m12 l6 settings_action input-field">
                                <button type="button" class="btn save_setting">Salvar</button>
                            </div>
                        </div>
                        <div class="row setting_edit">
                            <div class="col s12 m12 l6 input-field">
                                <input type="text" name="nickname" id="nickname" value="{{ Auth::user()->setting->nickname }}" maxlength="120">
                                <label for="nickname">Apelido</label>
                            </div>
                            <div class="col s12 m12 l6 settings_action input-field">
                                <button type="button" class="btn save_setting">Salvar</button>
                            </div>
                        </div>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l8 offset-l2">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card-panel">
                            <form action="/edit/profilepic" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="card">
                                            <a href="/storage/images/{{ Auth::user()->setting->profilepic }}" data-lightbox="setting-image">
                                                <div class="card-image">
                                                    <xf-thumb width="100%" height="250px" src="/storage/images/{{ Auth::user()->setting->profilepic }}"></xf-thumb>
                                                </div>
                                            </a>
                                        <div class="card-action">
                                                <div class="row">
                                                    <div class="col s12 m12 l12 input-field file-field">
                                                        <div class="btn" style="width: 100%">
                                                            <span>Procurar</span>
                                                            <input type="file" name="profilepic" id="profilepic">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12 input-field">
                                                        <button type="submit" class="btn" style="width: 100%;">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel">
                            <form action="/edit/wallpaper" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="card">
                                            <a href="/storage/images/{{ Auth::user()->setting->wallpaper }}" data-lightbox="setting-image">
                                                <div class="card-image">
                                                    <xf-thumb width="100%" height="250px" src="/storage/images/{{ Auth::user()->setting->wallpaper }}"></xf-thumb>
                                                </div>
                                            </a>
                                            <div class="card-action">
                                                <div class="row">
                                                    <div class="col s12 m12 l12 input-field file-field">
                                                        <div class="btn" style="width: 100%">
                                                            <span>Procurar</span>
                                                            <input type="file" name="wallpaper" id="wallpaper">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m12 l12 input-field">
                                                        <button type="submit" class="btn" style="width: 100%;">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        var token = '{{ csrf_token() }}';

        $(document).ready(function () {
            $('.save_setting').on('click',function (event) {
                event.preventDefault();

                var el = event.target;
                var setting_name = el.parentNode.parentNode.childNodes[0].childNodes[0].name
                var setting_value = el.parentNode.parentNode.childNodes[0].childNodes[0].value
                var setting_id = el.parentNode.parentNode.childNodes[0].childNodes[0].id


                $.ajax({
                    method: 'POST',
                    url: '/edit/setting',
                    data: {setting_name: setting_name, setting_value: setting_value, _token: token}
                }).done(function (res) {
                    console.log(res);
                    $('#'+setting_id).val(res.newValue);
                });
            });
        });
    </script>
@endsection