@extends('layouts.app')

@section('content')
   <div class="container"> <div class="row">
           <a href="{{route('export.excel',['user'=>'user'])}}" class="btn btn-success" style="margin-bottom: 30px;">Export Users to Excel</a>
           <a href="{{route('admin.user.create')}}" class="btn btn-gray" style="margin-left: 30px;margin-bottom: 30px;">Create a new user</a>
           <table class="table table-striped">
               <tr>
                   <th>Username</th>
                   <th>Email</th>

                   <th>ID</th>
                   <th>ID Status</th>
                   <th>Action</th>
               </tr>
               @foreach($users as $user)
                   <tr>

                       <td>{{$user->username}}</td>
                       <td>{{$user->email}}</td>

                       <td><a href="{{asset('valid_ids/'.$user->valid_id)}}" target="_blank">{{$user->valid_id}}</a>

                       </td>
                       <td>
                           @if($user->valid_id)
                               @if($user->valid_id_status == 1)
                                   Accepted
                               @else
                                   <a href="{{route('moderator.user.valid_id',['id'=>$user->id,'accept'=>1])}}" class="btn btn-success" style="padding: 0 5px;">Accept</a>
                                   <a href="{{route('moderator.user.valid_id',['id'=>$user->id,'accept'=>1])}}" class="btn btn-danger" style="padding: 0 5px;">Decline</a>
                               @endif
                           @else
                               Wating to upload
                           @endif
                       </td>

                       @if(!empty(App\Moderator::where('user_id',Auth::user()->id)->where('type',2)->first()))
                       <td><a href="{{route('moderator.user.edit',['id'=>$user->id])}}" class="btn btn-success" style="padding: 0 5px;">Edit</a></td>
                      @endif
                   </tr>
               @endforeach
           </table>

       </div>
   </div>
@endsection

