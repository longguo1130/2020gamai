@extends('layouts.app')

@section('content')
    <div class="container"> <div class="row">

            <table class="table table-striped">
                <tr>
                    <th>Username</th>
                    <td>{{\App\UserAccount::find($user->id)?\App\UserAccount::find($user->id)->firstName.''.\App\UserAccount::find($user->id)->middleName.' ' .\App\UserAccount::find($user->id)->lastName :'Not inputed yet'}}</td>

                    <th>Email</th>

                    <th>ID</th>
                    <th>ID Status</th>

                </tr>
                @foreach($users as $user)
                    <tr>

                        <td>{{$user->username}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

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


                    </tr>


                @endforeach
            </table>

        </div>
    </div>
@endsection

