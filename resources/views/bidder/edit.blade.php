@extends('layouts.product.editbid')

@section('main_content')



    <form id="bid-info" class="bid-content" method="POST" action="{{ route('bidders.update',['id'=>$bid->id]) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">

                    <span>Bid</span>

                    <input id="bid_price" type="text" class="form-control" name="bid_price" value="{{$bid->bid_price}}">

                </div>
                <div class="col-md-6">
                    <span>Duration</span>
                    <select class="form-control" name="duration" id="duration">
                        <option value="0">Select Duration</option>
                        <option value="Day" {{ old('duration') == 1 ? 'selected' : '' }}>Day</option>
                        <option value="Week" {{ old('duration') == 2 ? 'selected' : '' }}>Week</option>
                        <option value="Month" {{ old('duration') == 3 ? 'selected' : '' }}>Month</option>
                        <option value="Year" {{ old('duration') == 4 ? 'selected' : '' }}>Year</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <span>Comments</span>
                    <textarea id="comments" type="text" name="comments" class="form-control" >{{$bid->comments}}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Submit</button>

        </div>
    </form>


@endsection
