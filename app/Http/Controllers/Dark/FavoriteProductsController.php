<?php

namespace App\Http\Controllers\Dark;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FavoriteProductsController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
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

        return $this->returnSuccess();
    }

    public function removeFavorite(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $favoriteProduct = Favorite::query()->where(['product_id' => $product->id, 'user_id' => auth()->id()])->delete();

        return $this->returnSuccess();
    }


    public function favorites(Request $request)
    {
        return View::make('dark.favorite_page.favorite', [
            'product' => auth()->user()->favorites
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
