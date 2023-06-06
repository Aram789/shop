<?php

namespace App\Http\Controllers\Light;

use App\Http\Controllers\Dark\BaseController;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteProductsController extends BaseController
{
    public function addFavorite(Request $request): JsonResponse
    {

        $product = Product::findOrFail($request->product_id);

        $favoriteProduct = Favorite::query()->where(['product_id' => $product->id, 'user_id' => auth()->id()])->first();


        if (empty($favoriteProduct)) {
            $favorite = new Favorite();
            $favorite->user_id = auth()->id();
            $favorite->product_id = $product->id;
            $favorite->save();
        }
        $countFavorite = count(Favorite::query()->get());
        return $this->returnSuccess(data:['countFavorite' => $countFavorite]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFavorite(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->product_id);

        $favoriteProduct = Favorite::query()->where(['product_id' => $product->id, 'user_id' => auth()->id()])->delete();
        $countFavorite = count(Favorite::query()->get());
        return $this->returnSuccess(data:['countFavorite' => $countFavorite]);
    }

    public function favorites ()
    {
        return \Illuminate\Support\Facades\View::make('Light.favorites', [   'product' => auth()->user()->favorites]);
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
