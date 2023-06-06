<?php

namespace App\Http\Controllers\Dark;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends BaseController
{
    public function products(Product $id): \Illuminate\Contracts\View\View
    {
        return View::make('Dark.product_page.product', [
            'product' => $id
        ]);
    }

    public function categoryProduct(Category $category)
    {

        return View::make('Dark.category_product_page', [
            'category' => $category,
        ]);
    }

    public function filters(Request $request)
    {
        $query = Product::query();
        foreach ($request->filters as $filter) {
            if (!in_array($filter['name'], Product::FILTERS)) {
                continue;
            }
            if ($filter['name'] == 'min_price') {
                $query = $query->where('price', '>=', $filter['value']);
            } elseif ($filter['name'] == 'max_price') {
                $query = $query->where('price', '<=', $filter['value']);
            } else {
                $query = $query->where($filter['name'], $filter['value']);
            }
        }

        $products = $query->paginate(Product::PAGINATION_COUNT);

        if ($request->ajax()) {
            return response()->json([
                'products' => view::make('dark.components.filtered_products', [
                    'products' => $products
                ])->render()
            ]);
        }

        return view('Dark/home', [
            'products' => $products,
        ]);

    }
}
