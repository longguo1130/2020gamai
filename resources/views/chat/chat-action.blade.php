<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 4/22/2020
 * Time: 10:37 PM
 */
?>

@if($bid->status == 1)

    <a href="{{route('profile',['id'=>Auth::user()->id])}}" class="btn btn-gray delete_transaction_mobile" >View profile</a>


@else
    <a href="{{route('bidders.complete',['id'=>$bid->id])}}" class="btn btn-success">Complete</a>
    <a href="{{route('bidders.cancel',['id'=>$bid->id])}}" class="btn btn-dark">Cancel</a>
@endif
