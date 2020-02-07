<div class="row">

        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>City</th>



            </tr>
            @foreach($city as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->city}}</td>
                </tr>


            @endforeach
        </table>



</div>
