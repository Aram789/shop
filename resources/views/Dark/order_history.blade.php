@extends('Dark.layouts.app')
@section('content')
    <section class="h-100 gradient-custom" id="order_history_page">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Thanks for your Order, <span
                                    style="color: #a8729a;">{{Auth::user()->name }}</span>!
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="card shadow-0 border mb-4">
                                @if(!empty($orders) && count($orders))
                                    @foreach($orders as $order)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="d-flex align-items-center">
                                                    <div class="left_panel_product p-3">
                                                        <div class="asked-question-box d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                                             href="#multiCollapseExample1{{$order->id}}"
                                                             role="button" aria-expanded="false"
                                                             aria-controls="multiCollapseExample1">
                                                            <strong> Order number :
                                                                {{ $order->order_number }}
                                                            </strong>
                                                            <strong class="text-secondary">
                                                                Invoice Date :{{$order->created_at}}
                                                            </strong>
                                                        </div>
                                                        @foreach($order->orderItems as $product)
                                                            <div class="collapse multi-collapse" id="multiCollapseExample1{{$order->id}}">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Unit-price</th>
                                                                        <th scope="col">Total-price</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class=" border-bottom align-middle position-relative" data-id="{{$product->id}}">
                                                                            <td class="border-0">
                                                                                <a href="{{route('products', $product->id)}}" class="text-info">
                                                                                    <img width="20"
                                                                                         src="{{$product->image ? $product->image : asset('images/Dark/no-img.jpg') }}"
                                                                                         class="basket_product_img" alt="img"/>
                                                                                    {{$product->name}}
                                                                                </a>
                                                                            </td>
                                                                            <td class="border-0">{{$product->pivot->quantity}}</td>
                                                                            <td class="border-0">{{$product->price}}$</td>
                                                                            <td class="border-0">{{$product->pivot->quantity * $product->price}} $</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    body main{
        padding-top: 50px !important;
    }
</style>
