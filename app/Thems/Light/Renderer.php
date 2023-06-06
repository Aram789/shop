<?php
namespace App\Thems\Light;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class Renderer
{
    /**
     * @param string $page
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function renderPage(string $page): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::query()->paginate(Product::PAGINATION_COUNT);


        return view('Light/'. $page, [
            'products' => $products,
        ]);
    }
}
