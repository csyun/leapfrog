<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index($cid)
    {
        $goods = Admin_Goods::where('cid',$cid)-get();
        return view('Home.Goods.list');
    }
}
