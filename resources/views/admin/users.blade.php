<div class="row">
    <a href="{{route('export.excel',['user'=>'user'])}}" class="btn btn-success" style="margin-bottom: 30px;">Export Users to Excel</a>
    <a href="{{route('admin.user.create')}}" class="btn btn-gray" style="margin-left: 30px;margin-bottom: 30px;">Create a new user</a>
    <table class="table table-striped">
        <tr>
            <th>Username</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Email Verified</th>
            <th>Facebook Verified</th>
            <th>Google Verified</th>
            <th>Apple Verified</th>
            <th>Verify Status</th>
            <th>Bid Limit</th>
            <th>Transaction Count</th>
            <th>Rating</th>
            <th>ID</th>
            <th>ID Status</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
            <tr>

                <td>{{$user->username}}</td>
                <td>{{\App\UserAccount::find($user->id)?\App\UserAccount::find($user->id)->firstName.''.\App\UserAccount::find($user->id)->middleName.' ' .\App\UserAccount::find($user->id)->lastName :'Not inputed yet'}}</td>
                <td>{{$user->email}}</td>
                @if($user->email_verified_at)
                    <td>Verified</td>
                @else
                    <td><a href="{{route('admin.verify.email',['id'=>$user->id])}}">Verify</a></td>
                @endif
                @if(App\SocialAccount::where('user_id',$user->id)->where('provider','facebook')->first())
                    <td>Facebook verified</td>
                @else
                    <td><a href="#">No,yet</a></td>
                @endif
                @if(App\SocialAccount::where('user_id',$user->id)->where('provider','google')->first())
                <td>Google verified</td>
                @else
                    <td><a href="#">No,yet</a></td>
                @endif
                @if(App\SocialAccount::where('user_id',$user->id)->where('provider','sign-in-with-apple')->first())
                    <td>Apple verified</td>
                @else
                    <td><a href="#">No,yet</a></td>
                @endif
                <td>{{$user->verify_status}}</td>
                <td>{{$user->bid_count}}</td>
                <td>{{$user->transaction_count}}</td>
                <td>{{$user->rating}}</td>
                <td><a href="{{asset('valid_ids/'.$user->valid_id)}}" target="_blank">{{$user->valid_id}}</a>

                </td>
                <td>
                 @if($user->valid_id)
                     @if($user->valid_id_status == 1)
                         Accepted
                         @else
                            <a href="{{route('admin.user.valid_id',['id'=>$user->id,'accept'=>1])}}" class="btn btn-success" style="padding: 0 5px;">Accept</a>
                            <a href="{{route('admin.user.valid_id',['id'=>$user->id,'accept'=>2])}}" class="btn btn-danger" style="padding: 0 5px;">Decline</a>
                        @endif
                    @else
                    Wating to upload
                     @endif
                </td>
                <td><a href="{{route('admin.user.edit',['id'=>$user->id])}}" class="btn btn-success" style="padding: 0 5px;">Edit</a>
                    <a href="{{route('admin.user.delete',['id'=>$user->id])}}" class="btn btn-danger" style="padding: 0 5px;" onclick="return confirm('Are you sure?')">Delete</a></td>

            </tr>
        @endforeach
    </table>

</div>
