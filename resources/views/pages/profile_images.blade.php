@extends('layouts.app')

@section('title')Imagens de {{ $user->name.' '.$user->last_name }} @endsection

@section('description')Gostou das imagens de {{ $user->name.' '.$user->last_name }} ? Cadastre-se agora e publique as suas também! @endsection

@section('content')
    @include('components.navbar')


    <div class="container">
    <div class="row">
        <div class="col l12 s12 m12">
            @include('components.my_info')
        </div>
    </div>
    <div class="row">
        <div id="profile-page-sidebar" class="col push-m12 push-l8 s12 m4 l4">
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
                        <div class="col s5 grey-text darken-1"><i class="mdi-account-location mdi"></i> Localidade</div>
                        <div class="col s7 grey-text text-darken-4 right-align">{{ $user->setting->country }}</div>
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

            <!-- Profile About  -->
            <div class="card amber darken-2">
                <div class="card-content white-text center-align">
                    <p class="card-title"><i class="mdi-social-group-add"></i> 1287</p>
                    <p>Seguidores</p>
                </div>
            </div>
            <!-- Profile About  -->

            <!-- Profile feed  -->
            <ul id="profile-page-about-feed" class="collection z-depth-1">
                <li class="collection-item avatar">
                    <img src="images/avatar.jpg" alt="" class="circle">
                    <span class="title">Project Title</span>
                    <p>Task assigned to new changes.
                        <br> <span class="ultra-small">Second Line</span>
                    </p>
                    <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="mdi-file-folder circle"></i>
                    <span class="title">New Project</span>
                    <p>First Line of Project Work
                        <br> <span class="ultra-small">Second Line</span>
                    </p>
                    <a href="#!" class="secondary-content"><i class="mdi-social-domain"></i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="mdi-action-assessment circle green"></i>
                    <span class="title">New Payment</span>
                    <p>Last UK Project Payment
                        <br> <span class="ultra-small">$ 3,684.00</span>
                    </p>
                    <a href="#!" class="secondary-content"><i class="mdi-editor-attach-money"></i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="mdi-av-play-arrow circle red"></i>
                    <span class="title">Latest News</span>
                    <p>company management news
                        <br> <span class="ultra-small">Second Line</span>
                    </p>
                    <a href="#!" class="secondary-content"><i class="mdi-action-track-changes"></i></a>
                </li>
            </ul>
            <!-- Profile feed  -->

        </div>

        <div class="col pull-m14 pull-l4 l8 s12 m12">
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
    </div>
</div>

@include('components.footer')

@endsection