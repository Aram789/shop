<div class="basket-buttons-container">
    @if(!in_array($product->id, $basketProductIds ?? []))
        <button type="button" class="btn btn-danger add-to-cart" data-id="{{$product->id}}"><i class="fa-solid fa-cart-plus"></i></button>
    @else
        <button class="btn btn-danger remove-from-cart" data-id="{{$product->id}}">Remove from cart</button>
    @endif
</div>
