@if($message->from_user == \Auth::user()->id)

    <div class="row msg_container base_sent" data-message-id="{{ $message->id }}">
        <div class="col-md-9 col-xs-9 col-sm-8 col-8">
            <div class="messages msg_sent text-right">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
        <div class="col-md-3 col-xs-3 col-sm-4 col-4 avatar">
            <img src="{{$message->fromUser->avatar}}" class="img-responsive">
        </div>
    </div>

@else

    <div class="row msg_container base_receive" data-message-id="{{ $message->id }}">
        <div class="col-md-3 col-xs-3 col-sm-4 col-4 avatar">
            <img src="{{$message->fromUser->avatar}}"  class=" img-responsive ">
        </div>
        <div class="col-md-9 col-xs-9 col-sm-8 col-8">
            <div class="messages msg_receive text-left">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>

@endif
