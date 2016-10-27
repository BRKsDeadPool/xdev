<div class="card-image hoverable">
    <a href="{{ url('/myprofile') }}"><img src="{{ asset('/storage/images/'.Auth::user()->setting->profilepic) }}" class="responsive-img"></a>
</div>
<div class="card-content">
    <a href="#" class="black-text"><h5>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h5></a>
    <p>{{ Auth::user()->setting->status }}</p>
    <ul>
        <li class="margin"><a href="{{ url('/stalk') }}" class="black-text"><span class="red-text text-accent-5 mdi mdi-eye"></span> Stalkear</a></li>
        <li class="margin"><a href="#" class="black-text"><span class="red-text text-accent-5 mdi mdi-account-search"></span> Encontrar Amigos</a></li>
        <li class="margin"><a href="#" class="black-text"><span class="red-text text-accent-5 mdi mdi-account-multiple"></span> Meus amigos</a></li>
        <li class="margin"><a href="#" class="black-text"><span class="red-text text-accent-5 mdi mdi-account-location"></span> Sobre você</a></li>
    </ul>
</div>