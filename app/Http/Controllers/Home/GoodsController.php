<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends CommonController
{
    public function index($id)
    {
        $goods = Admin_Goods::where('cid',$id)->where('status', '0')
            ->paginate(1);
        $input=$id;
        return view('Home.Goods.list',compact('goods','input'));
    }
    public function seach(Request $request)
    {
        $input = $request->input('gname');
        $goods = Admin_Goods::where('status', '0')
            ->where('gname','like','%'.$input.'%')->paginate(2);
        return view('Home.Goods.list',compact('goods','input'));
    }
    public function details($id)
    {
        $goods = Admin_Goods::find($id);
//        dd($goods);
        return view('home.goods.details',compact('goods'));
    }
}