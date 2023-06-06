<?php

namespace App\Http\Controllers\Dark;


use App\Thems\SClass;

class HomeController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $them = 'Light';
        $rendererClass = SClass::getTheme($them);

        return $rendererClass->renderPage('home');

    }
}
