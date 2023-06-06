<?php

namespace App\Http\Controllers\Dark;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $basketProducts = auth()->user()->basketProducts;
                $favorites = auth()->user()->favorites->pluck('id')->toArray();
            }
            $categories = Category::query()->whereHas('products')->withCount('products')->get();

            view()->share([
                'basketProducts' => $basketProducts ?? null,
                'categories' => $categories,
                'basketProductIds' => isset($basketProducts) ? $basketProducts->pluck('id')->toArray() : null,
                'favorites' => $favorites ?? [],
            ]);

            return $next($request);
        });

    }
}
