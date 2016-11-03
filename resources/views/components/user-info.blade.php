<div class="card-image hoverable">
    <a href="{{ url('/profile?id='.Auth::user()->id) }}">
	<xf-thumb width="100%" height="170px" src="/storage/images/{{ Auth::user()->setting->profilepic }}"></xf-thumb>
</div>
<div class="card-content">
    <a href="{{ url('/profile?id='.Auth::user()->id) }}" class="black-text"><h5>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h5></a>
    <p>{{ Auth::user()->setting->status }}</p>
    <ul>
        <li class="margin"><a href="{{ url('/stalk') }}" class="black-text"><span class="red-text text-accent-5 mdi mdi-eye"></span> Stalkear</a></li>
        <li class="margin"><a href="{{ url('/find') }}" class="black-text"><span class="red-text text-accent-5 mdi mdi-account-search"></span> Encontrar Amigos</a></li>
        <li class="margin"><a href="{{ url('/profile/friends?id='.Auth::user()->id) }}" class="black-text"><span class="red-text text-accent-5 mdi mdi-account-multiple"></span> Meus amigos</a></li>
    </ul>
</div>

<div class="card blue">
    <a href="/profile/friends?id={{ Auth::user()->id }}">
        <div class="card-content white-text center-align">
            <p class="card-title"><i class="mdi-social-group-add"></i>{{ count(Auth::user()->getAcceptedFriendships()) }}</p>
            <p>{{ count(Auth::user()->getAcceptedFriendships()) > 1 ? 'Amigos' : 'amigo' }}</p>
        </div>
    </a>
</div>

<div class="card amber darken-3">
    <a href="/profile?id={{ Auth::user()->id }}">
        <div class="card-content white-text center-align">
            <p class="card-title"><i class="mdi-social-group-add"></i>{{ count(Auth::user()->posteds) }}</p>
            <p>{{ count(Auth::user()->posteds) > 1 ? 'Posts' : 'Post' }}</p>
        </div>
    </a>
</div>

