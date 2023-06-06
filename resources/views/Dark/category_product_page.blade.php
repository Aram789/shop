@extends('Dark.layouts.app')


@section('content')
    <div class="text-center">
        <strong class="fs-1">{{$category->name}}</strong>
    </div>
    <section class="container">
        <div class="row">
            <div class="text-center py-5">
                <div class="row">
                    @if(!empty($category->products) && count($category->products))
                        @foreach($category->products as $product)
                            @component('Dark.components.item', ['product' => $product])@endcomponent
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection



