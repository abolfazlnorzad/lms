
@if(session()->has('feedback'))
    @foreach(session()->get('feedback') as $msg)
        $.toast({
        heading: '{{$msg['title']}}',
        text: '{{$msg['body']}}',
        showHideTransition: 'slide',
        icon: '{{$msg['type']}}'
        })
    @endforeach
@endif
