@extends('layouts.app')

@if(isset($term))
@section('title')Resultados da busca por "{{ $term }}" @endsection
@else
@section('title')Pesquise e encontre seus amigos e conheça pessoas novas @endsection
@endif

@section('content')
@include('components.navbar')

    @if(isset($term))
        <div class="row">
            <div class="col l8">
                <div class="card-panel">
                    @if(isset($users))
                        @if(count($users)>0)
                            @if(count($users) == 1)
                                <h4>{{ count($users) }} Usuario Encontrado</h4>
                            @else
                                <h4>{{ count($users) }} Usuarios Encontrados</h4>
                            @endif
                            @foreach($users as $user)
                                <div class="row">
                                    <div class="col l12">
                                        <div class="card horizontal">
                                            <div class="card-image">
                                                <a href="{{ route('get.profile',['id'=>$user->id]) }}">
                                                    <img src="{{ asset('/storage/images/'.$user->setting->profilepic) }}" alt="{{ $user->name.' '.$user->last_name }}" style="max-width: 150px">
                                                </a>
                                            </div>
                                            <div class="card-stacked">
                                                <div class="card-content">
                                                    <a href="{{ route('get.profile',['id'=>$user->id]) }}">
                                                        <h5>{{ $user->name.' '.$user->last_name }}</h5>
                                                    </a>
                                                    {{ $user->setting->status }}
                                                </div>
                                                <div class="card-action profile_actions">
                                                    <a href="{{ route('get.profile.images',['id'=>$user->id]) }}" class="btn-flat">Imagens</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="red padding accent-5 center white-text">
                                <h4>Não foram encontrados resultados</h4>
                            </div>
                        @endif
                    @endif

                    @if(isset($posts))
                        @foreach($posts as $post)

                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col l4">
                <div class="card-panel">
                    <h5>Ultimos termos buscados</h5>
                    @if(count($last_searches) > 0)
                        <div class="collection">
                            @foreach($last_searches as $search)
                                <a href="{{ url('/search?term='.$search->term) }}" class="collection-item dismissable">{{ $search->term }} <span data-badge-caption="{{ $search->results > 1 ? 'resultados' : 'resultado' }}" class="new badge">{{ $search->results }}</span></a>
                            @endforeach
                        </div>
                    @else
                        <div class="collection">
                            {{ $last_searches }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <main>
            <div class="row">
                <div class="col l8 s12 m12">
                    <div class="row card-panel" style="height: 280px">
                        <div class="col l12 s12 m12">
                            <div>
                                Pesquise, encontre e conheça novas pessoas!
                                <form class="search" action="{{ url('/search') }}">
                                    <div class="row col l12 s12 m12 input-field">
                                        <span class="prefix mdi mdi-account-search"></span>
                                        <input type="text" name="term" id="term" class="search_term" placeholder="Digite o que deseja encontrar">
                                    </div>
                                    <button hidden type="submit"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l4 s12 m12">
                    <div class="card-panel">
                        <h5>Ultimos termos buscados</h5>
                        @if(count($last_searches) > 0)
                            <div class="collection">
                                @foreach($last_searches as $search)
                                    <a href="{{ url('/search?term='.$search->term) }}" class="collection-item dismissable">{{ $search->term }} <span data-badge-caption="{{ $search->results > 1 ? 'resultados' : 'resultado' }}" class="new badge">{{ $search->results }}</span></a>
                                @endforeach
                            </div>
                        @else
                            <div class="collection">
                                <a href="{{ url('/search?term='.$last_searches->term) }}" class="collection-item dismissable">{{ $last_searches->term }} <span data-badge-caption="{{ $last_searches->results > 1 ? 'resultados' : 'resultado' }}" class="new badge">{{ $last_searches->results }}</span></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br><br><br><br><br>
        </main>
    @endif

    @include('components.footer')

@endsection