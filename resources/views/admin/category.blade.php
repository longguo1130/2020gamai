<div class="row">
    <div class="col-9">
        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Category</th>



            </tr>
            @foreach($category as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->category}}</td>
                </tr>


            @endforeach
        </table>

    </div>




</div>
