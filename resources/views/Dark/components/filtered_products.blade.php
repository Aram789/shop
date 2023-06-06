<div class="row">
    @if(!empty($products) && count($products))
        @foreach($products as $product)
            @component('Dark.components.item', ['product' => $product])@endcomponent
        @endforeach
    @else
        <strong class="fs-1 border-top border-bottom">No Product</strong>
    @endif
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
</div>
