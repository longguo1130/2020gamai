<div class="row">
    <table class="table table-striped">
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Zipcode</th>
            <th>Birthday</th>
            <th>ID</th>
            <th>ID Status</th>
            <th>Action</th>
        </tr>
        @foreach($accounts as $account)
            <tr>

               <td>{{App\User::find($account->id)->username}}</td>
               <td>{{$account->firstName}}</td>
               <td>{{$account->middleName}}</td>
               <td>{{$account->lastName}}</td>
               <td>{{$account->house_number}},{{$account->street}},{{$account->town}},{{$account->city}},{{$account->province}},{{$account->country}}</td>
                <td>{{$account->zipcode}}</td>
                <td>{{$account->birthday}}</td>
                <td><a href="{{asset('valid_ids/'.App\User::find($account->id)->valid_id)}}" target="_blank">{{App\User::find($account->id)->valid_id}}</a>

                <td>
                    @if(App\User::find($account->id)->valid_id)
                        @if(App\User::find($account->id)->valid_id_status == 1)
                            Accepted
                        @else
                            <a href="{{route('admin.user.valid_id',['id'=>$account->id,'accept'=>1])}}" class="btn btn-success" style="padding: 0 5px;">Accept</a>
                            <a href="{{route('admin.user.valid_id',['id'=>$account->id,'accept'=>2])}}" class="btn btn-danger" style="padding: 0 5px;">Decline</a>
                        @endif
                    @else
                        Wating to upload
                    @endif
                </td>

                </td>
                <td><a href="{{route('admin.user.edit',['id'=>$account->id])}}" class="btn btn-success" style="padding: 0 5px;">Edit</a>
                    <a href="{{route('admin.user.delete',['id'=>$account->id])}}" class="btn btn-danger" style="padding: 0 5px;" onclick="return confirm('Are you sure?')">Delete</a></td>

            </tr>
        @endforeach
    </table>

</div>
