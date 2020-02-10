@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('moderator.user.store',['id'=>$user->id]) }}">
            <div class="form-group">
                <label for="">{{$user->name}}</label>
            </div>
            <div class="form-group">
                <label for="">Input Bid Limit</label>
                <input type="text"  name="bid_count" value="{{ $user->bid_count }}">
            </div>
            <div class="form-group">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
