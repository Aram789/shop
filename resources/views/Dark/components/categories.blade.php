{{--Categories--}}
<nav class="navbar position-relative">
    <div class="container-fluid">
                    <span class="navbar-toggler border-0 d-flex align-items-center p-0" type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                          aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </span>
        <div class="collapse navbar-collapse categories_collapse" id="navbarTogglerDemo03">
            <div class="p-3 d-flex flex-wrap mt-3">
                @if(!empty($categories) && count($categories))
                    @foreach($categories as $categoriesProduct)
                        @component('Dark.components.categories_product', ['categories' => $categoriesProduct])@endcomponent
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</nav>
{{---------------- --}}
