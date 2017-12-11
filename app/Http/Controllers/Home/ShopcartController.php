<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use App\Models\ShopCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShopcartController extends Controller
{
//    public function test()
//    {
////        $n = 0;
////        $cprice = 0;
//        $user = Session('homeuser');
////        if ($user) {
//        $arr = ShopCart::where('uid', $user['uid'])->get();
//        foreach ($arr as $k => $v) {
//            Session::push('goods', Admin_Goods::find($v->gid));
////            $cprice += Admin_Goods::find($v->gid)->gprice;
////            $n++;
////            }
//
////        }
//        }
//        dd(session('goods'));
//    }

    /**
     * 添加商品到购物车
     *
     */
    public function tocart($id)
    {
        $user = Session('homeuser');
        if ($user) {
            $goods = ShopCart::where('uid', $user['uid'])->get();
            $gid[] = '';
            foreach ($goods as $k => $v) {
                $gid[] = $v->gid;
            }
            if (in_array($id, $gid)) {
                $data['error'] = 2;
                $data['msg'] = "请勿重复添加";
            } else {
                $Cart = new ShopCart();
                $Cart->uid = Session('homeuser')['uid'];
                $Cart->gid = $id;
                $res = $Cart->save();
                if ($res) {
                    $data['error'] = 0;
                    $data['msg'] = "加入购物车成功";
                } else {
                    $data['error'] = 1;
                    $data['msg'] = "加入购物车失败";
                }
            }
        } else {
            $goods = session('goods');
            $gid[] = '';
            if($goods){
                    foreach ($goods as $k => $v) {
                        $gid[] = $v->gid;
                    }
                       if(in_array($id, $gid)) {
                           $data['error'] = 2;
                           $data['msg'] = "请勿重复添加";
                       }else {
                            $g = [];
                           $goods = Admin_Goods::find($id);
                           Session::push('goods', $goods);
                           foreach (session('goods') as $k => $v) {
                              $g[]= $v->gid;
                           }
                           $res = in_array($id,$g);
                           if ($res) {
                               $data['error'] = 0;
                               $data['msg'] = "加入购物车成功";
                           } else {
                               $data['error'] = 1;
                               $data['msg'] = "加入购物车失败";
                           }
                       }
            } else {
                $g=[];
                $goods = Admin_Goods::find($id);
                Session::push('goods', $goods);
                foreach (session('goods') as $k => $v) {
                    $g[]= $v->gid;
                }
                $res = in_array($id,$g);
                if ($res) {
                    $data['error'] = 0;
                    $data['msg'] = "加入购物车成功";
                } else {
                    $data['error'] = 1;
                    $data['msg'] = "加入购物车失败";
                }
            }
        }
        return $data;
    }

    public function index()
    {
        $user = Session('homeuser');
        if ($user) {
            $arr = ShopCart::where('uid', $user['uid'])->get();

            foreach ($arr as $k => $v) {
                if(empty(session('goods')[$k]->gid)) {
                        Session::push('goods', Admin_Goods::find($v->gid));
                }else{
                    if (!((session('goods')[$k]->gid) == $v->gid)) {
                        Session::push('goods', Admin_Goods::find($v->gid));
                    }
                }
            }
            $goods = session('goods');
            $n = count($goods);
            return view('Home.ShopCart.list', compact('goods','n'));
        }else{
            $goods = session('goods');
            $n = count($goods);
            return view('Home.ShopCart.list', compact('goods','n'));
        }
    }
    public function cartDel(Request $request,$id)
    {
        $user = Session('homeuser');
        $k = $request->input('k');
        if ($user) {
            $res = ShopCart::where('gid', $id)->delete();
            $row = session()->pull('goods', $k);
            if ($res && $row) {
                $data['error'] = 0;
                $data['msg'] = "删除成功";
            } else {
                $data['error'] = 1;
                $data['msg'] = "删除失败";
            }
        } else {
            $row = session()->pull('goods.'.$k);
            if ($row) {
                $data['error'] = 0;
                $data['msg'] = "删除成功";
            } else {
                $data['error'] = 1;
                $data['msg'] = "删除失败";
            }

        }
        return $data;
    }
    public function pay()
    {
        $goods = session('goods');
        return view('Home.ShopCart.pay',compact('goods'));
    }
}
