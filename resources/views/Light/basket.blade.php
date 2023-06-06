@extends('Light.layouts.app')

@section('content')
    <div class="container" id="basket_page">
        <div class="row mx-0 text-white gap-3">
            <strong class="fs-1">Basket</strong>
            @if(!empty($product) && count($product))
                @foreach($product as $products)
                    @component('Light.components.item', ['product' => $products])@endcomponent
                @endforeach
            @else
                <strong class="fs-1 d-block text-center py-5 text-white">Empty</strong>
            @endif
        </div>
    </div>
@endsection
