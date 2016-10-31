@if(count(Auth::user()->notifications) > 0 )
    <ul class="collection">
        @foreach(Auth::user()->notifications as $notification)
            <?php $notifier = \App\User::find($notification->data['notifier']) ?>
            @if($notification->data['notifier'] != Auth::user()->id)
                <li class="collection-item avatar">
                    <a href="profile?id={{ $notifier->id }}">
                        <img src="storage/images/{{ $notifier->setting->profilepic }}" alt="{{ $notifier->name.' '.$notifier->last_name }}" class="circle">
                        <span class="title grey-text text-darken-2">{{ $notifier->name.' '.$notifier->last_name }}</span>
                    </a>
                    <p class="grey-text">{{ $notification->data['message'] }}</p>
                    <a href="{{ $notification->data['url'] }}" class="secondary-content"><i class="mdi mdi-link"></i></a>
                </li>
            @endif
        @endforeach
    </ul>
@endif