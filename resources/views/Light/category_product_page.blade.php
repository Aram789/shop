@extends('Light.layouts.app')


@section('content')
    <div class="text-center mb-4">
        <strong class="fs-1 text-white">{{$category->name}}</strong>
    </div>
    <section class="container">
        <div class="row gap-3 text-white">
            @if(!empty($category->products) && count($category->products))
                @component('Light.components.categories')@endcomponent
                @foreach($category->products as $product)
                    @component('Light.components.item', ['product' => $product])@endcomponent
                @endforeach
            @else
                <strong class="fs-1 d-block text-center py-5 text-white">Empty</strong>
            @endif
        </div>
    </section>

@endsection



