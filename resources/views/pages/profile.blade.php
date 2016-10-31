@extends('layouts.app')

@section('title')Perfil de {{ $user->name.' '.$user->last_name }} @endsection

@section('description'){{ $user->name.' '.$user->last_name }} se cadastrou no XFind, cadastre-se você também e fique por dentro de tudoo que esta pessoa está fazendo. @endsection

@section('content')
    {{ \Carbon\Carbon::setLocale('pt_BR') }}
    {{ Carbon\Carbon::setToStringFormat('m y h:i:s') }}

    @include('components.navbar')
    <section id="content">

        <!--start container-->
        <div class="container">

            <div id="profile-page" class="section">
                @include('components.my_info')

                <!-- profile-page-content -->
                <div id="profile-page-content" class="row">
                    <!-- profile-page-sidebar-->
                    <div id="profile-page-sidebar" class="col push-m8 push-l8 s12 m4 l4">
                        <!-- Profile About  -->
                        <div class="card red accent-5">
                            <div class="card-content white-text">
                                <span class="card-title">Sobre mim!</span>
                                <p>{{ $user->setting->about }}</p>
                            </div>
                        </div>
                        <!-- Profile About  -->

                        <!-- Profile About Details  -->
                        <ul id="profile-page-about-details" class="collection z-depth-1">
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mif" style="font-size: 16pt; position:relative; top:5px;">timeline</i> Publicações</div>
                                    <div class="col s7 grey-text text-darken-4 right-align">{{ count($user->posteds) }}</div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mdi-account-multiple mdi"></i> Amigos</div>
                                    <div class="col s7 grey-text text-darken-4 right-align">{{ $user->getFriendsCount() }}</div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s5 grey-text darken-1"><i class="mdi-cake mdi" style="font-size: 16pt; position:relative;"></i> Birth date</div>
                                    <div class="col s7 grey-text text-darken-4 right-align">{{ $user->setting->birthday }}</div>
                                </div>
                            </li>
                        </ul>
                        <!--/ Profile About Details  -->

                        @if(count($user->getAcceptedFriendships()) > 0)
                        <!-- Profile About  -->
                        <div class="card blue">
                            <a href="/profile/friends?id={{ $user->id }}">
                                <div class="card-content white-text center-align">
                                    <p class="card-title"><i class="mdi-social-group-add"></i>{{ count($user->getAcceptedFriendships()) }}</p>
                                    <p>{{ count($user->getAcceptedFriendships()) > 1 ? 'Amigos' : 'amigo' }}</p>
                                </div>
                            </a>
                        </div>
                        <!-- Profile About  -->
                        @endif

                        @if(count($user->getAcceptedFriendships()) > 0)
                            <ul id="profile-page-about-feed" class="collection z-depth-1">
                            @foreach($user->getAcceptedFriendships() as $friendship)
                                <!-- Profile feed  -->
                                        <li class="collection-item avatar">
                                            <a href="profile?id={{ $friendship->sender->id != $user->id ? $friendship->sender->id : $friendship->recipient->id }}">
                                                <img src="storage/images/{{ $friendship->sender->id != $user->id ? $friendship->sender->setting->profilepic :  $friendship->recipient->setting->profilepic}}" alt="{{ $friendship->sender->id != $user->id ? $friendship->sender->name.' '.$friendship->sender->name :  $friendship->recipient->name.' '.$friendship->recipient->name }}" class="circle">
                                            </a>
                                            <a href="profile?id={{ $friendship->sender->id != $user->id ? $friendship->sender->id : $friendship->recipient->id }}">
                                                <span class="title">{{ $friendship->sender->id != $user->id ? $friendship->sender->name.' '.$friendship->sender->last_name :  $friendship->recipient->name.' '.$friendship->recipient->last_name }}</span>
                                            </a>
                                            <p>Amigos desde {{ $friendship->created_at->format('d F \d\e Y') }}
                                                <br> <span class="ultra-small">Second Line</span>
                                            </p>
                                        </li>
                                    <!-- Profile feed  -->
                            @endforeach
                            </ul>
                        @endif

                    </div>
                    <!-- profile-page-sidebar-->

                    <!-- profile-page-wall -->
                    <div class="col pull-m4 pull-l4 s12 m8 l8 timeline">
                        @if(count($posts))
                            <div class="card-panel">
                                @include('components.feeds-form')
                            </div>
                        @endif
                    </div>
                    <!--/ profile-page-wall -->

                </div>
            </div>
        </div>
        </div>
        <!--end container-->
    </section>

    @include('components.footer')
@endsection