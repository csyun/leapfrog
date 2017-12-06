<?php

namespace App\Http\Controllers\Home;

use App\Models\RecycleGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecycleListController extends Controller
{
    public function index()
    {
        $recyclegoods = RecycleGoods::get();
        return view('Home\Recycle\list',compact('recyclegoods'));
    }
}
