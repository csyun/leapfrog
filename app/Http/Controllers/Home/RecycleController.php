<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RecycleGoods;

class RecycleController extends Controller
{
    public function index()
    {
        $recyclegoods = RecycleGoods::get();
        return view('Home\Recycle\list',compact('recyclegoods'));
    }
}
