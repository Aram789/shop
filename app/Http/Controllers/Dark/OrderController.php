<?php

namespace App\Http\Controllers\Dark;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $basketProducts = $user->basketProducts;
        $data = [];
        foreach ($basketProducts as $product) {
            $data[$product->id] = ['quantity' => $product->pivot->quantity];
        }
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $request->total_price;
        $order->address = $request->address;
        $order->order_number = Str::uuid();
        $order->save();
        $order->orderItems()->sync($data);
        $user->basketProducts()->sync([]);
        $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
        $smallBasket = \view('Dark.components.small-basket', ['basket' => $basketProducts])->render();

        return $this->returnSuccess(data:  ['smallBasket'=> $smallBasket]);

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function history()
    {
        return View::make('Dark.order_history',[
            'orders' => auth()->user()->orders
        ]);
    }

    public function returnSuccess(?string $message = '', ?array $data = []): JsonResponse
    {
        return response()->json([
            'success' => 'Success',
            'message' => $message,
            'data' => $data
        ], 200);
    }
}


