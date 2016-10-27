@if(isset($errors))
    @foreach($errors as $error)
        <script>
            Materialize.toast('{{ $error }}', 4000, 'warning rounded');
        </script>
    @endforeach
@endif

@if(isset($messages))
    @if(count($messages) > 1)
        @foreach($messages as $message)
            <script>
                Materialize.toast('{{ $message }}', 4000, 'warning rounded');
            </script>
        @endforeach
    @else
        <script>
            Materialize.toast('{{ $messages }}', 4000, 'warning rounded');
        </script>
    @endif
@endif