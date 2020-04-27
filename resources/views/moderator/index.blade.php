@extends('layouts.app')

@section('content')
   <div class="container"> <div class="row">

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
                                   <a href="{{route('moderator.user.valid_id',['id'=>$user->id,'accept'=>1])}}" class="btn btn-success" style="padding: 0 5px;">Accept</a>
                                   <a href="{{route('moderator.user.valid_id',['id'=>$user->id,'accept'=>2])}}" class="btn btn-danger" style="padding: 0 5px;">Decline</a>
                               @endif
                           @else
                               Wating to upload
                           @endif
                       </td>
                       <td><a href="{{route('moderator.user.edit',['id'=>$user->id])}}" class="btn btn-success" style="padding: 0 5px;">Edit</a></td>


                   </tr>


               @endforeach
           </table>

       </div>
   </div>
@endsection

