<div class="row">
    <table class="table table-striped">
        <tr>
            <th>From User</th>
            <th>To user</th>
            <th>Content</th>
            <th>Date</th>

        </tr>
        @foreach($messages as $message)
            <tr>

                <td>{{$message->fromUser['username']}}</td>
                <td>{{$message->toUser['username']}}</td>
                <td>{{$message->content}}</td>
                <td>{{$message->created_at}}</td>

            </tr>


        @endforeach
    </table>

</div>
