<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_Goods;
use App\Models\Cate;
use App\Models\Recommend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    /**
     * 修改商品状态
     *$id是传过来的商品id
     */

    public function  gstatus($gid)
    {
        $good = Admin_Goods::find($gid);
        $status = !$good->status;
        $res = $good->update(['status'=>$status]);
        if($res){
            $data =[
                'gg'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
                'gg'=> 1,
                'msg'=>'修改失败'
            ];
        }
        dd($data);
        return $data;

    }

    /**
     * 商品展示
     *
     */
    public function index(Request $request)
    {

        $good = Admin_Goods::orderBy('gid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $goodname= $request->input('keywords1');

                if(!empty($goodname)) {
                    $query->where('gname','like','%'.$goodname.'%');
                }


            })
            ->paginate(2);
//        dd($good);
        return view('Admin.Goods.index',compact('good','request'));
    }

    /**
     * 商品添加页
     *
     */
    public function create()
    {
        $cates = (new Cate())->relation();
        $pid = array_column($cates,'pid');
        $pid = array_unique($pid);
        $recommend = Recommend::get();
        return view('Admin.Goods.add',compact('cates','pid','recommend'));
    }

    /**
     * 执行商品添加
     *
     */
    public function store(Request $request)
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
            return redirect('admin/goods/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $good = new Admin_Goods();
        $good->gname = $data['gname'];
        $good->cid= $data['cid'];
        $good->status = $data['status'];
        $good->gprice = $data['gprice'];
        $good->gpurl = $data['gpurl'];
        $good->gdesc= $data['gdesc'];
        $row = $good->save();
        if($row){
            return redirect('admin/goods')->with('msg','添加成功');
        }else{
            return redirect('admin/goods/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 商品修改页
     *$id是传过来的商品id
     */
    public function edit($id)
    {

       $good = Admin_Goods::find($id);
       $cates = (new Cate())->relation();
       $pid = array_column($cates,'pid');
       $pid = array_unique($pid);
        $recommend = Recommend::get();
       return view('Admin.Goods.edit',compact('good','cates','pid','recommend'));
    }

    /**
     * 执行商品修改
     *$id是传过来的商品id
     */
    public function update(Request $request, $id)
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
            return redirect('admin/goods/'.$good->gid.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $res = $good->update($input);
        if($res){
            return redirect('admin/goods')->with('msg','修改成功');
        }else{
            return redirect('admin/goods'.$good->gid.'/edit');
        }
    }

    /**
     * 商品删除
     *$id是ajax传过来的商品id
     */
    public function destroy($id)
    {
        $res = Admin_Goods::find($id)->delete();
        $data = [];
        if ($res) {
            $data['gg'] = 0;
            $data['msg'] = "删除成功";
        } else {
            $data['gg'] = 1;
            $data['msg'] = "删除失败";
        }
        return $data;
    }
}
