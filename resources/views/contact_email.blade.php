@component('mail::message')
    {{--Hello Gamai Company, from *{{$name}}*  --}}{{-- use double space for line break --}}
    {{--{{$message}}--}}

    <hr>

        From:{{$name}}
        Subject:@if( $type == 'contact')Contact Us @else Support @endif

        Email:{{$email}}
        @if($contact)Contact:{{$contact}}@endif

        Message:
        {{$message}}

@endcomponent
