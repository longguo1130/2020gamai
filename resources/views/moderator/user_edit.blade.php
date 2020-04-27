@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('moderator.user.store',['id'=>$user->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="active_image" class="active_image" value="0">
            <div class="row">

                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="birthday" class="col-md-4 control-label">Bid Count</label>
                        <input id="bid_count" type="text" class="birthday form-control" name="bid_count" value="{{ $user->bid_count }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="membership " class="col-md-4 control-label">Membership</label>
                        <select class="form-control" name="membership" id="membership">
                            <option value="0">Select Membership</option>
                            <option value="1" {{ old('membership') == 1 ? 'selected' : '' }}>Trial Pack</option>
                            <option value="2" {{ old('membership') == 2 ? 'selected' : '' }}>Starter Pack</option>
                            <option value="3" {{ old('membership') == 3 ? 'selected' : '' }}>Advance Pack</option>
                            <option value="4" {{ old('membership') == 4 ? 'selected' : '' }}>Master Pack</option>
                            <option value="5" {{ old('membership') == 5 ? 'selected' : '' }}>Bronze Pack</option>
                            <option value="6" {{ old('membership') == 6 ? 'selected' : '' }}>Silver Pack</option>
                            <option value="7" {{ old('membership') == 7 ? 'selected' : '' }}>Gold Pack</option>
                            <option value="8" {{ old('membership') == 8 ? 'selected' : '' }}>Platinum Pack</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Submit</button> <button class="btn btn-success">Dismiss</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
