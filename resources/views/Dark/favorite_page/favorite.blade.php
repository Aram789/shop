@extends('Dark.layouts.app')

@section('content')
    <section class="container favorites-container">
        <div class="text-center py-5">
            <div class="row">
            @if(!empty($product) && count($product))
                @foreach( $product as $favoriteProduct)
                    @component('Dark.components.item', ['product' => $favoriteProduct])@endcomponent
                @endforeach
                @else
                    <strong class="text-center fs-2 d-block">Favorite Products not exists</strong>
            @endif
            </div>
        </div>
    </section>
@endsection

