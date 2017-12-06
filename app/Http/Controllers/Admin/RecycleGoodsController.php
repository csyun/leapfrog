<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecycleGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RecycleGoodsController extends Controller
{
    /**
     * 显示可回收商品列表
     * @auth 曹守云
     * @date 2017/12/06 8:20
     * @return 返回可回收商品列表视图  \Illuminate\Http\Response
     */
    public function index()
    {
        $recyclegoods = RecycleGoods::get();
        return view('Admin\RecycleGoods\index',compact('recyclegoods'));
    }

    /**
     * 显示可回收商品添加页面
     * @auth 曹守云
     * @date 2017/12/06 8:30
     * @return 返回添加回收商品视图  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\RecycleGoods\add');
    }

    /**
     * 把添加页面提交的数据存到数据库
     * @auth 曹守云
     * @date 2017/12/06 8:50
     * @param 添加页面提交的数据 \Illuminate\Http\Request  $request
     * @return 返回执行结果 \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        //表单验证规则
        $rule = [
            'rgname'=>'required',
            "rgprice"=>'required|numeric',

        ];
        $mess = [
            'rgname.required'=>'商品名称必须输入',
            'rgprice.required'=>'回收基础价格必须输入',
            'rgprice.numeric'=>'回收基础价格必须是数字',

        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/recyclegoods/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = RecycleGoods::create($input);
        if($res)
        {
            return  redirect('/admin/recyclegoods')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
     * 展示一个带着老数据的编辑页面
     * @auth 曹守云
     * @date 2017/12/06 9:10
     * @param 要编辑商品的id int  $id
     * @return 返回编辑视图 \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recyclegood = RecycleGoods::find($id);
        //dd($recyclegood);
        return view('Admin\RecycleGoods\edit',compact('recyclegood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','file_upload','_method');
        //表单验证规则
        $rule = [
            'rgname'=>'required',
            "rgprice"=>'required|numeric',

        ];
        $mess = [
            'rgname.required'=>'商品名称必须输入',
            'rgprice.required'=>'回收基础价格必须输入',
            'rgprice.numeric'=>'回收基础价格必须是数字',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/recyclegoods/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = RecycleGoods::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/recyclegoods')->with('msg','修改成功');;
        }else{
            return back()->with('msg','修改失败');;
        }
    }

    /**
     * 删除数据中的一条记录
     * @auth 曹守云
     * @date 2017/12/06 9:00
     * @param 要删除商品的 int  $id
     * @return 返回执行结果 \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = RecycleGoods::find($id)->delete();
        $data = [];
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        return $data;
    }
}
