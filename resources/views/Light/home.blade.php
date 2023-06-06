@extends('Light.layouts.app')

@section('content')
    <div class="container">
        <div class="row mx-0 text-white gap-3">
            @if(!empty($products) && count($products))
                @component('Light.components.categories')@endcomponent
                @foreach($products as $product)
                    @component('Light.components.item', ['product' => $product])@endcomponent
                @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
            @endif
        </div>
    </div>
@endsection
