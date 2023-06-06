<?php

namespace App\Http\Controllers\Light;

use App\Http\Controllers\Dark\BaseController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends BaseController
{
    public function products(Product $id): \Illuminate\Contracts\View\View
    {
        return View::make('Light.product_page.product', [
            'product' => $id
        ]);
    }
    public function categoryProduct(Category $category)
    {
        return View::make('Light.category_product_page', [
            'category' => $category,
        ]);
    }
}
