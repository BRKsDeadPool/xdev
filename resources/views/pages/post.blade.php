@extends('layouts.app')

@if(isset($post))
@section('title')Post de {{ $post->poster->name.' '.$post->poster->last_name }} @endsection
@section('content')
    @if(count($post->images) < 1)
        <br><br><br><br>
    @endif
    <div class="row">
        <div class="col offset-l2 l8 s12 m12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="row">
                            <div class="col s2 m2 l1">
                                <a href="profile?id={{ $post->poster->id }}">
                                    <xf-thumb src="/storage/images/{{ $post->poster->setting->profilepic }}" alt="{{ $post->poster->name.' '.$post->poster->last_name }}" width="70px" height="70px"></xf-thumb>
                                </a>
                            </div>
                            <div class="col s10 m10 l11">
                                <br><br>
                                <a href="profile?id={{ $post->poster->id }}">
                                    {{ $post->poster->name.' '.$post->poster->last_name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l7">
                        <div class="row">
                            @if($post->body != '')
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <blockquote style="-ms-word-wrap: break-word;word-wrap: break-word;">{{ $post->body }}</blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(count($post->images) > 0)
                            <div class="row">
                                <div class="col l12 s12 m12">
                                    @foreach($post->images as $image)
                                        <a href="/storage/images/{{ $image->name }}" data-lightbox="post_image" data-title="{{ $post->poster->name.' '.$post->poster->last_name }}">
                                            <xf-thumb src="/storage/images/{{ $image->name }}" alt="{{ $post->poster->name.' '.$post->poster->last_name }}" width="100%" height="500px"></xf-thumb>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col l8 s12 m12">
                                <div class="left post_actions">
                                    <a href="post?id={{ $post->id }}" class="center">{{ $post->created_at->diffForHumans() }}</a>

                                    <button class="post_like post-react btn-floating waves-effect red accent-5 margin hoverable" onclick="like({{ $post->id }}, 'like', 'likecount-{{ $post->id }}')" data-action="like" data-postid="{{ $post->id }}">
                                        <span class="mdi mdi-thumb-up"> </span>
                                        <span class="like_count" id="likecount-{{ $post->id }}"> {{ count($post->likes) > 0 ? count($post->likes) : '' }}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="{{ count($post->images) > 0 ? 'col l4 s12 m12 ' : 'col l12 s12 m12' }}">
                        <ul class="collection">
                            <li class="collection-item">Aqui ficarão os comentarios</li>
                            <li class="collection-item">Aqui ficarão os comentarios</li>
                            <li class="collection-item">Aqui ficarão os comentarios</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    <br><br><br><br>
@endsection

@else
@section('title')
@section('content')
    <br><br><br><br>
    <div class="row">
        <div class="col l8 offset-l2 s12 m12">
            <div class="card-panel">
                <h2 class="center">Post não encontrado</h2>
            </div>
        </div>
    </div>
    <br><br><br><br>
@endsection
@endif

@section('script')
    <script>
        var token = '{{ csrf_token() }}';

        function like(postid, action, counterid) {
            $.ajax({
                method: 'post',
                url: '/vue/new/like',
                data: {_token: token, postid: postid, action: action }
            }).done(function (res) {
                if (res.likes < 1){
                    $('#'+counterid).empty();
                    return
                }
                $('#'+counterid).text(res.likes);
            });
        }
    </script>
@append