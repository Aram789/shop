
<div class="dropdown" data-aos="fade-down">
    <button class="btn btn-secondary dropdown-toggle categories_button" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Categories
    </button>
    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
        @if(!empty($categories) && count($categories))
            @foreach($categories as $category)
                @component('Light.components.categories_product', ['category' => $category])@endcomponent
            @endforeach
        @endif
    </ul>
</div>
