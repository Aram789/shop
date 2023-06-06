<?php

namespace App\Http\Controllers\Dark;

use App\Models\Category;

class CategoryController extends BaseController
{
    public function index(){
       $category =  Category::query()->where('id', '=', 1)->first();
       dd($category->products()->get());

    }
}
