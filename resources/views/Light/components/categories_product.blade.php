<li>
        <a href="{{route('categoryProduct.light', $category->id)}}" class="dropdown-item categories_item">
            {{$category->name}}
            ({{$category->products_count}})
        </a>
</li>

