<div class="row">
    <table class="table table-striped">
        <tr>
            <th>From User</th>
            <th>Content</th>
            <th>Date</th>

        </tr>
        @foreach($users as $user)
            <tr>

                <td>{{$user->username}}</td>
                <td>
                    @foreach(App\Message::where('from_user',$user->id)->get() as $post)
                        {{App\User::find($post->to_user)->username}}:<span style="color: blue;">{{$post->content}}</span>
                        <br>
                    @endforeach
                </td>
                <td>
                    @foreach(App\Message::where('from_user',$user->id)->get() as $post)
                        {{$post->created_at}}
                        <br>
                    @endforeach
                </td>
            </tr>


        @endforeach
    </table>

</div>
