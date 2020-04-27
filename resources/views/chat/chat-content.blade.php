<?php
/**
 * This is used in full chat page
 */
?>
<ul class="full-chat-area">
    @forelse($messages as $message)
        <li class="{{ $message->from_user == \Auth::user()->id ? 'sent' : 'replies'}}">

            <p>{{$message->content}}</p>
            <a href="{{route('bidder.review',['id'=>App\User::find($message->from_user)->id])}}">
                <img src="{{$message->fromUser->avatar}}" alt="" style="height: 30px;width: 30px;">

            </a>
        </li>
    @empty
        <li>There is no history</li>
    @endforelse
</ul>
