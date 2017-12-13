<?php

namespace App\Http\Controllers\Home;

use App\Models\Admin_Goods;
use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GoodsController extends CommonController
{
    public function index($id)
    {
        $goods = Admin_Goods::where('cid',$id)->where('status', '0')
            ->get();
        $input=$id;
        return view('Home.Goods.list',compact('goods','input'));
    }
    public function seach(Request $request)
    {
        $input = $request->input('gname');
        $goods = Admin_Goods::where('status', '0')
            ->where('gname','like','%'.$input.'%')->get();
        return view('Home.Goods.list',compact('goods','input'));
    }
    public function details($id)
    {
        $goods = Admin_Goods::find($id);
//        dd($goods);
        return view('home.goods.details',compact('goods'));
    }
    public function add()
    {
        $cates = (new Cate())->relation();
        $pid = array_column($cates,'pid');
        $pid = array_unique($pid);
        return view('Home.Goods.add',compact('cates','pid'));
    }
    public function doadd(Request $request)
    {
        $input = $request->except('_token');
        $rule = [
            'gname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',
            "gprice"=>'required|numeric'
        ];
        $mess = [
            'gname.required'=>'商品名称名称必须输入',
            'gname.regex'=>'商品名称不合法',
            'gprice.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格不合法',
        ];
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('home/goods/add')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $good = new Admin_Goods();
        $good->uid = session('homeuser')['uid'];
        $good->gname = $data['gname'];
        $good->cid= $data['cid'];
        $good->status = $data['status'];
        $good->gprice = $data['gprice'];
        $good->gpurl = $data['gpurl'];
        $good->gdesc= $data['gdesc'];
        $row = $good->save();
        if($row){
            return redirect('home/goods/browse')->with('msg','添加成功');
        }else{
            return redirect('admin/goods/add');
        }
    }
    public function browse()
    {
        $uid = session('homeuser')['uid'];
       $goods =  Admin_Goods::where('uid',$uid)->get();
        return view('Home.Goods.browse',compact('goods'));
    }
    public function edit($id)
    {
        $good =  Admin_Goods::find($id);
        $cates = (new Cate())->relation();
        $pid = array_column($cates,'pid');
        $pid = array_unique($pid);
        return view('Home.Goods.edit',compact('good','cates','pid'));
    }
    public function doedit(Request $request,$id)
    {
        $input = $request->except('_token');
        $good = Admin_Goods::find($id);
        $rule = [
            'gname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',
            "gprice"=>'required|numeric'
        ];
        $mess = [
            'gname.required'=>'商品名称名称必须输入',
            'gname.regex'=>'商品名称不合法',
            'gprcie.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格不合法',
        ];
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('home/goods/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $res = $good->update($input);
        if($res){
            return redirect('home/goods/browse')->with('msg','修改成功');
        }else{
            return redirect('home/goods/edit/'.$id);
        }
    }
}