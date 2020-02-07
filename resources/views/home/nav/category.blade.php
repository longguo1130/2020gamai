<div class="category_detail category_kind" style="">
    <ul class="">
        <li class="active" data-id="0">All</li>
        @foreach(App\Category::get() as $category)
        <li data-id="{{$category->id}}">{{$category->category}}</li>
        @endforeach
    </ul>
</div>
