<div class="basket-buttons-container">
    @if(!in_array($product->id, $basketProductIds ?? []))
        <button class="btn btn-danger add-to-cart" data-id="{{$product->id}}">Add to cart</button>
    @else
        <button  disabled class="btn btn-warning">Already added to cart</button>
        <button class="btn btn-danger remove-from-cart" data-id="{{$product->id}}">Remove from cart</button>
    @endif
</div>
