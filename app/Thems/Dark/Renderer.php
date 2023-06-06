<?php
namespace App\Thems\Dark;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Renderer
{
    /**
     * @param string $page
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function renderPage(string $page): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $products = Product::query()->paginate(Product::PAGINATION_COUNT);

        return view('Dark/'. $page, [
            'products' => $products,
        ]);
    }
}
