<?php

namespace App\Http\Controllers\Home;

use App\Models\Link;
use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {

        $navs = Nav::take(7)->get();

        view()->share('navs', $navs);
        $links = Link::take(10)->get();
        view()->share('links', $links);

    }
}
