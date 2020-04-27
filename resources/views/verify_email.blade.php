@component('mail::message')
    Hello **{{$name}}**,  {{-- use double space for line break --}}
    You can buy and sell easily here.
    Please verify your email address.
    <a href="{{route('user.verify.email',['id'=>$id,'token'=>base64_encode($email)])}}">Verify</a>
    Thanks
@endcomponent
