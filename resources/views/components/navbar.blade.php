<div class="navbar-fixed ">
    <nav>
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo margin-left-10">{{ config('app.name', 'XFind') }}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ url('/profile?id='.Auth::user()->id) }}">{{Auth::user()->name.' '.Auth::user()->last_name}}</a></li>
                <li><a href="{{ url('/') }}"><span style="position:relative; top: 5px" class="mif">timeline</span></a></li>
                <li>
                    <a href="#" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="friendship_dropdown" class="dropdown-button">
                        <span class="mif" style="position: relative;top: 5px">supervisor_account</span>
                        @if(count(Auth::user()->getFriendRequests()) > 0)
                            <span class="new badge">{{ count(Auth::user()->getFriendRequests()) }}</span>
                        @endif
                    </a>

                <ul id="friendship_dropdown" class="dropdown-content collection">
                    @if(count(Auth::user()->getFriendRequests()) > 0)
                    <li><a href="#">Suas solicitações de amizade:</a></li>
                    @foreach(Auth::user()->getFriendRequests() as $friendship)
                    <li class="collection-item avatar">
                        <div class="row">
                            <div class="col s1 m1 l1">
                                <div class="row">
                                    <div class="col s6 m6 l6">
                                        <xf-thumb width="60px" height="60px" src="/storage/images/{{ $friendship->sender->setting->profilepic }}" mclass="circle"></xf-thumb>
                                    </div>
                                    <div class="col s6 m6 l6">
                                        <span class="title">{{ $friendship->sender->name.' '.$friendship->sender->last_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s11 m11 l11">
                                <div href="#!" class="secondary-content row">
                                    <div class="col s6 m6 l6">
                                        <div class="btn-floating center nav-edit-friendship"
                                        data-action="accept"
                                        data-target="{{$friendship->sender->id}}"
                                        data-element="#user-{{$friendship->sender->id}}"
                                        id="user-{{$friendship->sender->id}}"><span class="mdi mdi-account-plus" style="position:relative; bottom: 7px"></span></div>
                                        <div class="btn-floating center nav-edit-friendship"
                                        data-action="deny"
                                        data-target="{{$friendship->sender->id}}"
                                        data-element="#user-{{$friendship->sender->id}}"
                                        id="user-{{$friendship->sender->id}}"><span class="mdi mdi-account-minus" style="position:relative; bottom: 7px"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                    @endforeach
                     @else
                        <li><a href="#">Não existem novos pedidos de amizade</a></li>
                        @endif
                        <li class="divider"></li>
                        <li><a href="#">Pessoas que você possa se interessar:</a></li>
                        @foreach(App\User::where('id','<>',Auth::user()->id)->limit(5)->with('setting')->get() as $user)
                            @if(isset($user))
                                @if(
				$user->isFriendWith(Auth::user()) == 'false' AND
				$user->hasFriendRequestFrom(Auth::user()) == 'false' AND
				$user->hasSentFriendRequestTo(Auth::user()) == 'false'
)
                                    <li class="collection-item avatar">
                                        <div class="row">
                                            <div class="col s6 m6 l6">
                                                <div class="row">
                                                    <div class="col s1 m1 l1">
                                                        <a href="/profile?id={{$user->id}}">
                                                            <xf-thumb width="60px" height="60px" src="/storage/images/{{ $user->setting->profilepic }}" mclass="circle"></xf-thumb>
                                                        </a>
                                                    </div>
                                                    <div class="col s11 m11 l11">
                                                        <span class="title">{{ $user->name.' '.$user->last_name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6 m6 l6">
                                                <div href="#!" class="secondary-content row">
                                                    <div class="input-field col s6 m6 l6">
                                                        <div class="btn-floating nav-edit-friendship"
                                                             data-action="send"
                                                             data-target="{{$user->id}}"
                                                             data-element="#user-{{$user->id}}"
                                                             id="user-{{$user->id}}">
                                                            <span class="mdi mdi-account-plus" style="position:relative; bottom: 7px"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </li>

                <li><a href="#!" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="settings_dropdown" class="dropdown-button"><span class="mif" style="position: relative;top: 5px">settings</span></a>
                    <ul id="settings_dropdown" class="dropdown-content white-text">
                        <li><a href="{{ url('/settings') }}">Configurações</a></li>
                        <li><a onclick="$('#logout_form').submit()">Sair</a><form action="{{ url('/logout') }}" id="logout_form" method="post">{{ csrf_field() }}</form></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

@section('script')
    <script>
        var token = '{{ csrf_token() }}';

        $(document).ready(function () {
            $('.nav-edit-friendship').on('click', function (ev) {
                ev.preventDefault();
                var el = ev.target.parentNode,
                        action = el.dataset['action'],
                        target = el.dataset['target'],
                        element = $(el.dataset['element']);

                console.log('action is: '+action+
                        'target is: '+target+
                        'element is: '+element);
                $.ajax({
                    method: 'POST',
                    url:    '/vue/set/friendship',
                    data:    {_token: token, action: action, target: target}
                }).done(function (res) {
                    if (res.status == 'success'){
                        switch (res.result){
                            case 'accepted':
                                Materialize.toast('Agora você e '+res.user.name+' são amigos!');
                                el.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
                                break;
                            case 'denied':
                                Materialize.toast('Você negou o pedido de amizade de '+res.user.name+'!');
                                el.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
                                break;
                            case 'sent':
                                element.data('action',res.action);
                                element.removeClass('mdi-account-plus').addClass('mdi-account-minus').addClass('mdi');
                                el.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
                                Materialize.toast('Pedido de amizade enviado para '+res.user.name+'!',4000);
                                break;
                            default:
                                Materialize.toast('No ceu tem pão, e morreu!', 4000, 'warning rounded');
                                break;
                        }
                        return;
                    }
                    Materialize.toast(res.message, 4000, 'warning');
                    return;
                });

            });
        });
    </script>
@append
