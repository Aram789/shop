<div class="col-lg-4 col-md-12 mb-4 product-item">
    <div class="card position-relative">
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="position-absolute favorites_icon {{ in_array($product->id, $favorites ?? []) ? 'active' : '' }}"
                 data-id="{{$product->id}}">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg fill="silver" height="20px" width="20px" version="1.1" id="Layer_1"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 501.28 501.28" xml:space="preserve">
<g>
    <polygon
        points="501.28,194.37 335.26,159.33 250.64,12.27 250.64,419.77 405.54,489.01 387.56,320.29 	"/>
    <polygon
        points="166.02,159.33 0,194.37 113.72,320.29 95.74,489.01 250.64,419.77 250.64,12.27 	"/>
</g>
</svg>
            </div>
        @else
            <a href="{{route('login')}}">
                <div class="position-absolute favorites_icon" data-id="{{$product->id}}">
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 501.28 501.28" xml:space="preserve">
<g>
    <polygon style="fill:silver;"
             points="501.28,194.37 335.26,159.33 250.64,12.27 250.64,419.77 405.54,489.01 387.56,320.29 	"/>
    <polygon style="fill:silver;"
             points="166.02,159.33 0,194.37 113.72,320.29 95.74,489.01 250.64,419.77 250.64,12.27 	"/>
</g>
</svg>
                </div>
            </a>
        @endif

        <a href="{{route('products', $product->id)}}">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light product_img"
                 data-mdb-ripple-color="light">
                <img
                    src="{{$product->image ? $product->image : asset('images/Dark/no-img.jpg') }}"
                    class="w-100" alt="img"/>
            </div>
        </a>
        <div class="card-body card-block" data-id="{{$product->id}}">
            <h5 class="card-title mb-3">{{$product->name}}</h5>
            <h6 class="mb-3">${{$product->price}}</h6>
            <div class="basket-buttons-container">
                @if(!in_array($product->id, $basketProductIds ?? []))
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <button class="btn btn-danger add-to-cart" data-id="{{$product->id}}">Add to cart</button>
                    @else
                        <a href="{{route('login')}}" class="btn btn-danger add-to-cart"> Add to cart </a>
                    @endif
                @else
                    <button class="btn btn-danger remove-from-cart" data-id="{{$product->id}}">Remove from cart</button>
                @endif
            </div>

        </div>
    </div>
</div>



