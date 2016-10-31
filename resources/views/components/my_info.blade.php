<!-- profile-page-header -->
<div id="profile-page-header" class="card">
    <div class="card-image waves-effect waves-block waves-light" style="height: 300px; overflow: hidden;">
        <a href="{{ asset('/storage/images/'.$user->setting->wallpaper) }}" data-lightbox="wallpaper">
            <xf-thumb width="100%" height="300px" src="/storage/images/{{ $user->setting->wallpaper }}" iclass="waves-effect waves-light" istyle="valign: middle"></xf-thumb>
        </a>
    </div>
    <figure class="card-profile-image" style="position:absolute; z-index: 2; bottom: 80px">
        <a href="/storage/images/{{ $user->setting->profilepic }}" data-lightbox="profilepic">
            <xf-thumb src="/storage/images/{{ $user->setting->profilepic }}" width="125px" height="125px" mclass="circle z-depth-2 responsive-img activator"></xf-thumb>
        </a>
    </figure>
    <div class="card-content grey lighten-3">
        <div class="row">
            <div class="col l3 s12 center-align offset-l2">
                <h4 class="card-title grey-text text-darken-4">{{ $user->name.' '.$user->last_name }}</h4>
                <a href="/profile?id={{$user->id}}"><p class="medium-small grey-text">{{ $user->setting->status }}</p></a>

            </div>
            <div class="col l2 s12 center-align">
                <h4 class="card-title grey-text text-darken-4">{{ count($user->images) }}+</h4>
                <a href="/profile/images?id={{ $user->id }}"><p class="medium-small grey-text">Imagens</p></a>
            </div>
            <div class="col l2 s12 center-align">
                <h4 class="card-title grey-text text-darken-4">{{ count($user->posteds) }}+</h4>
                <a href="/profile?id={{$user->id}}"><p class="medium-small grey-text">Posts</p></a>
            </div>
            <div class="col l2 s12 center-align">
                <h4 class="card-title grey-text text-darken-4">{{ count($user->getAcceptedFriendships()) }}+</h4>
                <a href="/profile/friends?id={{ $user->id }}"><p class="medium-small grey-text">{{ count($user->getAcceptedFriendships()) > 1 ? 'Amigos' : 'amigo' }}</p></a>
            </div>
            <div class="col s12 l1 right-align" style="position: relative; bottom:40px">
                <a class="btn-floating activator waves-effect waves-light darken-2 left">
                    <i class="mdi-account-outline mdi"></i>
                </a>
                @if(Auth::user()->id != $user->id)
                    @if(Auth::user()->isFriendWith($user) or Auth::user()->hasSentFriendRequestTo($user))
                        <a class="btn-floating waves-effect waves-light darken-2 right edit-friendship"
                           data-action="remove"
                           data-target="{{$user->id}}"
                           data-element="#user-{{$user->id}}">
                            <i class="mdi-account-minus mdi relation-status" id="user-{{$user->id}}"></i>
                        </a>
                    @elseif(Auth::user()->hasFriendRequestFrom($user))
                        <a class="btn-floating waves-effect waves-light darken-2 right edit-friendship"
                           data-action="deny"
                           data-target="{{$user->id}}"
                           data-element="#user-{{$user->id}}">
                            <i class="mdi-account-minus mdi relation-status" id="user-{{$user->id}}"></i>
                        </a>
                    @else
                        <a class="btn-floating waves-effect waves-light darken-2 right edit-friendship"
                           data-action="send"
                           data-target="{{$user->id}}"
                           data-element="#user-{{$user->id}}"
                           id="user-{{$user->id}}">
                            <i class="mdi-account-plus mdi relation-status" id="user-{{$user->id}}"></i>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="card-reveal">
        <p>
            <span class="card-title grey-text text-darken-4">{{ $user->name.' '.$user->last_name }} <i class="mdi-close mdi right"></i></span>
            @if($user->setting->profission != '')
                <span><i class="mdi-professional-hexagon mdi cyan-text text-darken-2"></i> {{ $user->setting->profission }}</span>
            @endif
        </p>

        <p><i class="mdi-information mdi cyan-text text-darken-2"></i> Sobre:{{ $user->setting->about }}</p>
        <p><i class="mdi-chart-bubble mdi cyan-text text-darken-2"></i> Status: {{ $user->setting->status }}</p>
        @if($user->setting->phone != '')
            <p><i class="mdi-phone mdi cyan-text text-darken-2"></i> Tel:  {{ $user->setting->phone }}</p>
        @endif
        <p><i class="mdi-email mdi cyan-text text-darken-2"></i> Email: {{ $user->email }}</p>
        <p><i class="mdi-calendar mdi cyan-text text-darken-2"></i> Data de nascimento: {{ $user->setting->birthday }}</p>
        @if($user->setting->country != '')
            <p><i class="mdi-earth mdi cyan-text text-darken-2"></i> Pais: {{ $user->setting->country }}</p>
        @endif
        <p><i class="mdi-calendar-plus mdi cyan-text text-darken-2"></i> Entrou no XFind em: {{ \Carbon\Carbon::createFromDate($user->created_at->year, $user->created_at->month,$user->created_at->day)->toDateString() }}</p>
    </div>
</div>
<!--/ profile-page-header -->

@section('script')
    <script>
        var token = '{{ csrf_token() }}';

        $(document).ready(function () {
           $('.edit-friendship').on('click', function (ev) {
               ev.preventDefault();
                var el = ev.target.parentNode,
                    action = el.dataset['action'],
                    target = el.dataset['target'],
                    element = $(el.dataset['element']);
                $.ajax({
                   method: 'POST',
                   url:    '/vue/set/friendship',
                   data:    {_token: token, action: action, target: target}
                }).done(function (res) {
                    if (res.status == 'success'){
                        if (res.action == 'remove'){
                            console.log(element);
                        ev.target.parentNode.dataset['action'] = res.action;
                        $(ev.target.parentNode).find('.relation-status').removeClass('mdi-account-plus').addClass('mdi-account-minus');
                        Materialize.toast(res.message, 4000, 'rounded');
                            return
                        }else {
                            console.log(element);
                        ev.target.parentNode.dataset['action'] = res.action;
                        $(ev.target.parentNode).find('.relation-status').removeClass('mdi-account-minus').addClass('mdi-account-plus');
                        Materialize.toast(res.message, 4000, 'rounded');
                            return
                        }
                    }
                    Materialize.toast(res.message, 4000, 'warning');
                    return
                });
           });
        });
    </script>
@append
