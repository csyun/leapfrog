<?php

namespace App\Http\Controllers\Home;

use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function Index()
    {
//        $FirstCate = Cate::where('pid',0)->get();
        $cate = (new Cate())->relation();
        return view('Home.Index',compact('cate'));
    }
}
