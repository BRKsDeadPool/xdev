@extends('layouts.app')

@if(isset($post))
@section('title')Post de {{ $post->poster->name.' '.$post->poster->last_name }} @endsection
@section('content')
    {{ \Carbon\Carbon::setLocale('pt_BR') }}
    @if(count($post->images) < 1)
        <br><br><br><br>
    @endif
    @include('components.navbar')
    <div class="row">
        <div class="col offset-l2 l8 s12 m12">
            <div id="profile-page-wall-post" class="card">
                <div class="card-profile-title">
                    <div class="row">
                        <div class="col s1">
                            <xf-thumb alt="{{ $post->poster->name.' '.$post->poster->last_name.' Profile Picture' }}" src="storage/images/{{ $post->poster->setting->profilepic }}" mclass="circle responsive-img valign profile-post-uer-image hoverable" width="50px" height="50px"></xf-thumb>
                        </div>
                        <div class="col s10">
                            <p class="grey-text text-darken-4 margin">{{ $post->poster->name.' '.$post->poster->last_name }}</p>
                            <span class="grey-text text-darken-1 ultra-small">Criou uma publicação  -
                                                            <a href="/post?id={{$post->id}}">
                                                                {{ $post->created_at->diffForHumans() }}
                                                            </a>
                                                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <p class="margin">{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
                @if($post->images != '')
                    @foreach($post->images as $image)
                        <div class="card-image profile-medium">
                            <div class="image-container">
                                <a href="/storage/images/{{ $image->name }}" data-lightbox="post_image">
                                    <xf-thumb width="100%" height="360px" src="/storage/images/{{ $image->name }}" alt="Image posted by {{ $image->user->name.' '.$image->user->last_name }} in {{$image->created_at}}"></xf-thumb>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="card-action row">
                    <div class="center post_actions">
                        <button class="post_like post-react btn-floating waves-effect red accent-5 margin hoverable" onclick="like({{ $post->id }}, 'like', 'likecount-{{ $post->id }}')">
                            <span class="mdi mdi-thumb-up"> </span>
                            <span class="like_count" id="likecount-{{ $post->id }}"> {{ count($post->likes) > 0 ? count($post->likes) : '' }}</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
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