<?php

namespace App\Http\Controllers\Light;

use App\Http\Controllers\Dark\BaseController;
use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BasketController extends BaseController
{
    public function add(Request $request)
    {
        $id = $request->product_id;
        if (!isset($id)) {
            return $this->returnError('Product Id required', 401);
        }
        $product = Product::query()->find($id);
        if (empty($product)) {
            return $this->returnError('Product not found', 401);
        }
        $user = auth()->user();
        $productInBasket = BasketProduct::query()->where(['product_id' => $product->id, 'user_id' => $user->id])->first();

        if (!empty($productInBasket)) {
            $productInBasket->quantity = ++$productInBasket->quantity;
            $productInBasket->save();
            $basketProductIds = auth()->user()->basketProducts()->pluck('product_id')->toArray();
            $basketButtons = \view('Light.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();
            $basketProducts = auth()->user()->load('basketProducts')->basketProducts;

            return $this->returnSuccess(data:  ['buttons' => $basketButtons, 'basketProductsCount' => count($basketProductIds ?? [])]);
        }

        $basketProduct = new BasketProduct();
        $basketProduct->user_id = $user->id;
        $basketProduct->product_id = $product->id;
        $basketProduct->quantity = 1;
        $basketProduct->save();
        $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
        $basketProductIds = auth()->user()->basketProducts()->pluck('product_id')->toArray();
        $basketButtons = \view('Light.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();
        return $this->returnSuccess(data:  ['buttons' => $basketButtons, 'basketProductsCount' => count($basketProductIds ?? [])]);

    }

    public function remove (Request $request)
    {
        $id = $request->product_id;
        if (!isset($id)) {
            return $this->returnError('Product Id required', 401);
        }
        $user = auth()->user();
        $product = Product::query()->find($id);
        if (empty($product)) {
            return $this->returnError('Product not found', 401);
        }
        BasketProduct::query()->where(['product_id' => $id, 'user_id' => $user->id])->delete();
        $basketProductIds = auth()->user()->basketProducts()->pluck('product_id')->toArray();
        $basketButtons = \view('Light.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();

        return $this->returnSuccess(data: ['buttons' => $basketButtons, 'basketProductsCount' => count($basketProductIds ?? [])]);

    }

    public function basket()
    {
        return \Illuminate\Support\Facades\View::make('Light.basket', [   'product' => auth()->user()->basketProducts]);
    }
    public function returnError(string $message, int $status): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $status);
    }

    public function returnSuccess(?string $message = '', ?array $data = []): JsonResponse
    {
        return response()->json([
            'success' => 'Success',
            'message' => $message,
            'data'  => $data
        ], 200);
    }

}
