<div class="card position-relative overflow-hidden" style="width: 18rem; background: #3f0951;" data-aos="fade-down">
    <a href="{{route('products.light', $product->id)}}">
        <div class="card_hover position-absolute gap-2 d-flex align-items-center justify-content-center">
            @if(\Illuminate\Support\Facades\Auth::check())
                @component('Light.components.basket-buttons', ['product' => $product])@endcomponent
                <button type="button"
                        class="favorite btn {{ in_array($product->id, $favorites ?? []) ? 'light_favorite_active' : '' }}"
                        data-id="{{$product->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" href="20" fill="silver">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                    </svg>
                </button>
            @endif
        </div>
    </a>
    <img
        src="{{$product->image ? $product->image : asset('images/Light/no-img.jpg') }}"
        class="w-100 card-img-top product_img" alt="img" style="object-fit: contain;"/>

    <div class="card-body">
        <p class="card-text">{{$product->name}}</p>
        <p class="card-text">{{$product->description}}</p>
    </div>
</div>

