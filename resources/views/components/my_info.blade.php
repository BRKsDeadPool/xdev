<div class="card">
    <div class="card-image">
        <a href="{{ asset('/storage/images/'.$user->setting->wallpaper) }}" data-lightbox="wallpaper">
            <div class="wallpaper waves-effect waves-light" style="
                    background-image: url({{ asset('/storage/images/'.$user->setting->wallpaper) }})"></div>
        </a>
        <div class="card-title">
            <a class="left" data-lightbox="images" href="{{ asset('/storage/images/'.$user->setting->profilepic) }}">
                <div class="profilepicture waves-effect waves-light" style="background-image: url({{ asset('/storage/images/'.$user->setting->profilepic) }});"></div>
                lol
            </a>
        </div>
    </div>
    <div class="card-content">
        <p>{{ $user->setting->status }}</p>
    </div>
    <div class="card-action">
        <a href="profile/images?id={{ $user->id }}">Imagens</a>
    </div>
</div>
