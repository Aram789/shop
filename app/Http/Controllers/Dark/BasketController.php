<?php

namespace App\Http\Controllers\Dark;

use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BasketController extends BaseController
{

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $basket = auth()->user()->basketProducts;
        return View::make('Dark.basket.index', ['basket' => $basket]);
    }

    public function checkout(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('Dark.basket.checkout');
    }


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
            $basketButtons = \view('Dark.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();
            $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
            $smallBasket = \view('Dark.components.small-basket', ['basket' => $basketProducts])->render();
            return $this->returnSuccess(data:  ['buttons' => $basketButtons,'smallBasket'=> $smallBasket, 'basketProductsCount' => count($basketProductIds ?? [])]);
        }

        $basketProduct = new BasketProduct();
        $basketProduct->user_id = $user->id;
        $basketProduct->product_id = $product->id;
        $basketProduct->quantity = 1;
        $basketProduct->save();
        $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
        $basketProductIds = auth()->user()->basketProducts()->pluck('product_id')->toArray();
        $smallBasket = \view('Dark.components.small-basket', ['basket' => $basketProducts])->render();
        $basketButtons = \view('Dark.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();

        return $this->returnSuccess(data: ['buttons' => $basketButtons, 'smallBasket'=> $smallBasket, 'basketProductsCount' => count($basketProductIds ?? [])]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request): JsonResponse
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
        $basketButtons = \view('Dark.components.basket-buttons', ['product' => $product, 'basketProductIds' => $basketProductIds])->render();
        $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
        $smallBasket = \view('Dark.components.small-basket', ['basket' => $basketProducts])->render();
        return $this->returnSuccess(data: ['buttons' => $basketButtons, 'smallBasket'=> $smallBasket, 'basketProductsCount' => count($basketProductIds ?? [])]);
    }

    /**
     * @return JsonResponse
     */
    public function decreaseQuantity(Request $request)
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
            if($productInBasket->quantity > 1){
                $productInBasket->quantity = --$productInBasket->quantity;
                $productInBasket->save();
                $basketProducts = auth()->user()->load('basketProducts')->basketProducts;
                $smallBasket = \view('Dark.components.small-basket', ['basket' => $basketProducts])->render();
                return $this->returnSuccess(data:['smallBasket'=> $smallBasket]);
            }
            return $this->returnError('Product count can not be small than 1', 422);
        }

        return $this->returnError('Product not in the basket', 422);
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
