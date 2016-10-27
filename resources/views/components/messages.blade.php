@if(count(App\Message::all()) > 0)
    @foreach(App\Message::all() as $message)
        <blockquote>
            {{ $message->user->name.' '.$message->user->last_name }}
            {{ $message->message }}
        </blockquote>
    @endforeach
@else
    Não há mensagens para mostrar!
@endif