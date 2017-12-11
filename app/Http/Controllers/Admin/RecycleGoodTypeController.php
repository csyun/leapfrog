<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecycleGoodType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RecycleGoodTypeController extends Controller
{
    /**
     * 展示回收商品类型列表
     * @auth 曹守云
     * @return 返回回收商品类型列表视图  \Illuminate\Http\Response
     */
    public function index()
    {
        $recyclegoodtype = RecycleGoodType::get();
        return view('Admin\RecycleGoodType\index',compact('recyclegoodtype'));
    }

    /**
     * 展示回收商品类型添加
     * @auth 曹守云
     * @return 返回回收商品类型添加视图  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\RecycleGoodType\add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        //dd($input);
        //表单验证规则
        $rule = [
            'type_name'=>'required'
        ];
        $mess = [
            'type_name.required'=>'名称必须输入'
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/recyclegoodtype/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = RecycleGoodType::create($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodtype')->with('msg','添加成功');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recyclegoodtype = RecycleGoodType::find($id);
        return view ('Admin/recyclegoodtype/edit',compact('recyclegoodtype'));
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
        $input = $request->except('_token');
        //表单验证规则
        $rule = [
            'type_name'=>'required'
        ];
        $mess = [
            'type_name.required'=>'名称必须输入'
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/recyclegoodtype/{$id}/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $res = RecycleGoodType::find($id)->update($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodtype')->with('msg','修改成功');
        }else{
            return back()->with('msg','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = RecycleGoodType::find($id)->delete();
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
