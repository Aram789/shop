@extends('Dark.layouts.app')

@section('content')
    <div class="container">
        @component('Dark.components.categories')@endcomponent
        <div class="row">
            <strong class="fs-1 text-center my-5 d-block">Bestsellers</strong>
        </div>
        <div class="row">
            <div class="d-flex align-items-start gap-4 flex-wrap">
                <div class="left_panel_product">
                    <form id="price_form">
                        <strong class="d-block p-3">Ֆիլտրեր ըստ պարամետրերի</strong>
                        <div class="border_dotted_top p-3">
                            <strong class="asked-question-box position-relative d-flex align-items-center m-0 mb-2" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Գին</strong>
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="d-flex justify-content-between change_block align-items-center mb-3">
                                    <input data-index="0" name="min_price" id="5-lower-value" value="0" class="min_price text-center">
                                    <span></span>
                                    <input data-index="0" name="max_price" id="5-upper-value" value="50000" class="max_price text-center">
                                </div>
                                <div class="nonlinear" data-min="0" data-max="50000" data-id="5"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-center products-container w-100">
                    <div class="row">
                        @if(!empty($products) && count($products))
                            @foreach($products as $product)
                                @component('Dark.components.item', ['product' => $product])@endcomponent
                            @endforeach
                                <div class="d-flex justify-content-center">
                                    {{ $products->links() }}
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




