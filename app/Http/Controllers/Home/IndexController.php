<?php

namespace App\Http\Controllers\Home;


use App\Models\Adver;
use App\Models\Articles;
use App\Models\Recommend;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $slideshows = SlideShow::orderBy('order','asc')->get();
        $recommend = Recommend::where('status', 1)->get();
        $articles = Articles::orderBy('number','asc')->paginate(5);
        $advers = Adver::orderBy('order','asc')->paginate(4);
        return view('Home\index',compact('slideshows','recommend','articles','advers'));
    }
}
