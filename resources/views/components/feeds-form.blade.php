@if(isset($posts))
    {{ \Carbon\Carbon::setLocale('pt_BR') }}
    {{ Carbon\Carbon::setToStringFormat('m y h:i:s') }}

    @if(count($posts) > 0)
        <div class="timeline">
            @foreach($posts as $post)
                <div class="timeline-event">
                    <div class="card timeline-content">
                        @if(count($post->images) > 0)
                            @foreach($post->images as $image)
                                <div class="card-image waves-effect waves-block waves-light" data-title="{{ $post->body }}">
                                    <a href="{{ asset('/storage/images/'.$image->name) }}" data-lightbox="post_image">
                                        <xf-thumb src="storage/images/{{ $image->name  }}" alt="{{ $post->body }}" width="100%" height="300px"></xf-thumb>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                        <div class="card-content">
                            <span class="card-title grey-text text-darken-4"><a href="/profile?id={{ $post->poster->id }}">{{ $post->poster->name.' '.$post->poster->last_name }}</a><i class="activator card-title mdi mdi-more right"></i></span>
                            @if(isset($post->body))
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <blockquote style="-ms-word-wrap: break-word;word-wrap: break-word;">{{ $post->body }}</blockquote>
                                    </div>
                                </div>
                            @endif
                            <div class="center post_actions">
                                <button class="post_like post-react btn-floating waves-effect red accent-5 margin hoverable" onclick="like({{ $post->id }}, 'like', 'likecount-{{ $post->id }}')" data-action="like" data-postid="{{ $post->id }}">
                                    <span class="mdi mdi-thumb-up"> </span>
                                    <span class="like_count" id="likecount-{{ $post->id }}"> {{ count($post->likes) > 0 ? count($post->likes) : '' }}</span></button>
                            </div>
                            <a href="post?id={{ $post->id }}" class="right">{{ $post->created_at->diffForHumans() }}</a>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Comentarios<i class="mdi mdi-close right"></i></span>
                            <p>Aqui ficarão os comentarios.</p>
                        </div>
                    </div>
                    <div class="timeline-badge white">
                        <a href="profile?id={{ $post->poster->id }}" class="hoverable padding circle">
                            <img class="responsive-img" src="{{ asset('/storage/images/'.$post->poster->setting->profilepic) }}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h4 class="red accent-5 white-text padding-20 center">Não existem novas publicações</h4>
    @endif
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