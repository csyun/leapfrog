<?php

namespace App\Http\Controllers\Home;
use App\Models\Adver;
use App\Models\Articles;
use App\Models\Nav;
use App\Models\Recommend;
use App\Models\SlideShow;

use App\Models\Cate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{

    /**
     * 展示前台首页页面
     * @date 2017/12/01 10:00
     * @auth 曹守云
     * @return  前台首页视图页面,携带需要的变量 slideshows轮播图  recommend推荐位 articles文章前5条 advers广告 recommends推荐位
    */
    public function index()
    {
        $slideshows = SlideShow::orderBy('order','asc')->get();
        $recommend = Recommend::where('status', 1)->get();
        $articles = Articles::orderBy('number','asc')->paginate(5);
        $advers = Adver::orderBy('order','asc')->paginate(4);
        $recommends = Recommend::with('goods')->get();
        //dd($recommends);
       $cate = (new Cate())->relation();
        return view('Home\index',compact('slideshows','recommend','articles','advers','recommends','cate'));
    }
    /**
     * 展示文章页面
     * @date 2017/12/07 8:30
     * @auth 曹守云
     * @param 要展示的id 默认id为1,展示商城公告,后台此条不可删除
     * @return  文章页面 携带文章列表 articles 文章列表变量和articleinfo 文章详情
     */
    public function ArticleShow($id=1)
    {
        $articleinfo = Articles::find($id);
        $articles = Articles::orderBy('number','asc')->paginate(10);
        return view('Home\Articles\article', compact('articles', 'articleinfo'));

    }

}
