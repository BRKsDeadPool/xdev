<div class="navbar-fixed ">
    <nav>
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo margin-left-10">{{ config('app.name', 'XFind') }}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ url('/myprofile') }}">{{Auth::user()->name.' '.Auth::user()->last_name}}</a></li>
                <li><a href="{{ url('/') }}"><span style="position:relative; top: 5px" class="mif">timeline</span></a></li>
                {{--<li>--}}
                    {{--<a href="#" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="friendship_dropdown" class="dropdown-button">--}}
                        {{--<span class="mif" style="position: relative;top: 5px">supervisor_account</span>--}}
                        {{--@if(count(Auth::user()->getPendingFriendships()) > 0)--}}
                            {{--<span class="new badge">{{ count(Auth::user()->getPendingFriendships()) }}</span>--}}
                        {{--@endif--}}
                    {{--</a>--}}

                        {{--<ul id="friendship_dropdown" class="dropdown-content collection">--}}
                            {{--@if(count(Auth::user()->getPendingFriendships()) > 0)--}}
                    {{--@foreach(Auth::user()->getPendingFriendships() as $friendship)--}}
                        {{--<xf-friendship-request :from="{{ $friendship->sender->load('setting') }}"></xf-friendship-request>--}}
                            {{--@endforeach--}}
                {{--@else--}}
                    {{--<li><a href="#">Não existem novos pedidos de amizade</a></li>--}}
                {{--@endif--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#">Pessoas que você possa se interessar:</a></li>--}}
                        {{--@foreach(App\User::where('id','<>',Auth::user()->id)->get() as $user)--}}
                    {{--<xf-friendship-suggest :to="{{ $user->load('setting') }}"></xf-friendship-suggest>--}}
                        {{--@endforeach--}}
                        {{--</ul>--}}
                {{--</li>--}}
                <li>
                    <a href="#friendships" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="friendship_dropdown" class="dropdown-button">
                        <span class="mif" style="position: relative;top: 5px">supervisor_account</span>
                        @if(count(Auth::user()->getPendingFriendships()) > 0)
                        <span class="new badge">{{ count(Auth::user()->getPendingFriendships()) }}</span>
                        @endif
                    </a>
                    <ul id="friendship_dropdown" class="dropdown-content collection">
                    @if(count(Auth::user()->getPendingFriendships()) > 0)
                        @foreach(Auth::user()->getPendingFriendships() as $friendship)
                            <xf-friendship-request :from="{{ $friendship->sender->load('setting') }}"></xf-friendship-request>
                        @endforeach
                        @else
                            <li><a href="#">Não existem novos pedidos de amizade</a></li>
                        @endif
                            <li class="divider"></li>
                            <li><a href="#">Pessoas que você possa se interessar:</a></li>
                        @foreach(App\User::where('id','<>',Auth::user()->id)->get() as $user)
                        <xf-friendship-suggest :to="{{ $user->load('setting') }}"></xf-friendship-suggest>
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
