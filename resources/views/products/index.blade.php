@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            What are you selling?
        </div>

        <div>
            <form method="get" action="products/create">
                <button type="submit">Add Product</button>
            </form>

        

            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">title Title</th>
             
                    <th scope="col">Price</th>
                    <th scope="col">Text</th>
                    <th scope="col">Commands</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                 
                        <td>{{ $post->price }}</td>
                        <td>{{ $post->text }}</td>
                        <td>
                            @foreach($products as $image)
                                @if($image->product_id == $post->id)
                                    <img src="{{ Storage::url($image->images) }}" height="100" width="100">
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <form method="get" action="products/{{ $post->id }}">
                                <button type="submit">Detail</button>
                            </form>
                            <form method="get" action="products/{{ $post->id }}/edit">
                                <button type="submit">Edit</button>
                            </form>
                            <form method="post" action="products/{{ $post->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </div>
@endsection
