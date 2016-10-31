@extends('layouts.app')
@section('title'){{ isset($user) ? 'Amigos de '.$user->name.' '.$user->last_name : 'Usuario não encontrado' }} @endsection

@section('content')
    @include('components.navbar')
    @if(!isset($user))
        <br><br><br><br><br><br><br>
        <div class="row">
            <div class="col s12 m12 l8 offset-l2">
                <div class="card-panel">
                    <h4 class="flow-text">Este usuario não foi encontrado! Lamentamos muito</h4>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
    @else
        @include('components.my_info')

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    @foreach($friends->chunk(4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $friend)
                                @if($friend->sender->id != $user->id)
                                    <div class="col l3 m6 s6">
                                        <div class="card">
                                            <a href="/profile?id={{ $friend->sender->id }}">
                                                <div class="card-image">
                                                    <xf-thumb src="/storage/images/{{ $friend->sender->setting->profilepic }}" width="100%" height="300px"></xf-thumb>
                                                    <span class="card-title white-text" style="text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;">{{ $friend->sender->name.' '.$friend->sender->last_name }}</span>
                                                </div>
                                            </a>
                                            <div class="card-action">
                                                <p>{{ $friend->sender->setting->status }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col l3 m6 s6">
                                        <div class="card">
                                            <a href="/profile?id={{ $friend->sender->id }}">
                                                <div class="card-image">
                                                    <xf-thumb src="/storage/images/{{ $friend->sender->setting->profilepic }}" width="100%" height="300px"></xf-thumb>
                                                    <span class="card-title white-text" style="text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;">{{ $friend->sender->name.' '.$friend->sender->last_name }}</span>
                                                </div>
                                            </a>
                                            <div class="card-action">
                                                <p>{{ $friend->sender->setting->status }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @include('components.footer')
@endsection