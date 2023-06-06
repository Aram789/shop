@if(!empty($basket) && count($basket))
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit-price</th>
                    <th scope="col">Total-price</th>
                </tr>
                </thead>
                <tbody>
                @php($total = 0)
                @foreach($basket as $key=> $product)
                    @php($total += $product->price * $product->pivot->quantity)
                    <tr class="border-top border-bottom align-middle position-relative" data-id="{{$product->id}}">
                        <th scope="row" class="border-0">{{++$key}}</th>
                        <td class="border-0">
                            <a href="{{route('products', $product->id)}}" class="text-info">
                                <img width="20"
                                     src="{{$product->image ? $product->image : asset('images/Dark/no-img.jpg') }}"
                                     class="basket_product_img" alt="img"/>
                                {{$product->name}}
                            </a>
                        </td>
                        <td class="quantity-container d-flex align-items-center border-0">
                            <button type="button" class="minus" data-id="{{$product->id}}">-</button>
                            <span class="quantity">{{$product->pivot->quantity}}</span>
                            <button type="button" class="plus" data-id="{{$product->id}}">+</button>
                        </td>
                        <td class="border-0">{{$product->price}}$</td>
                        <td class="border-0">{{$product->pivot->quantity * $product->price}} $</td>
                        <td class="border-0  remove-from-cart" data-id="{{$product->id}}">
                            <svg width="10" height="10" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 60.963 60.842"
                                 style="enable-background:new 0 0 60.963 60.842;" xml:space="preserve">
                                    <path style="fill:#9f9b9b;"
                                          d="M59.595,52.861L37.094,30.359L59.473,7.98c1.825-1.826,1.825-4.786,0-6.611  c-1.826-1.825-4.785-1.825-6.611,0L30.483,23.748L8.105,1.369c-1.826-1.825-4.785-1.825-6.611,0c-1.826,1.826-1.826,4.786,0,6.611  l22.378,22.379L1.369,52.861c-1.826,1.826-1.826,4.785,0,6.611c0.913,0.913,2.109,1.369,3.306,1.369s2.393-0.456,3.306-1.369  l22.502-22.502l22.501,22.502c0.913,0.913,2.109,1.369,3.306,1.369s2.393-0.456,3.306-1.369  C61.42,57.647,61.42,54.687,59.595,52.861z"/>
                            </svg>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between mb-4">
                <strong>Ընդհանուր գին</strong>
                <strong>{{$total}}$</strong>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{route('basket.index')}}" class="btn btn-outline-danger" type="submit">Show All</a>
                <button class="btn btn-primary confirm-order" data-user_id="{{Auth::user()->id}}" data-total_price="{{$total}}"  data-address="Erevan">оформить заказ</button>
            </div>
        </div>
    </div>
@else
    <strong class="d-block fs-6 text-center">в корзине ничего нету</strong>
@endif

