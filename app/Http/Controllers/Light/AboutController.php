<?php

namespace App\Http\Controllers\Light;

use App\Http\Controllers\Dark\BaseController;
use Illuminate\Support\Facades\View;


class AboutController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index (): \Illuminate\Contracts\View\View
    {
        return View::make('Light.about');
    }

}
