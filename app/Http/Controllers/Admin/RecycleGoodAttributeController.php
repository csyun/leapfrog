<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoodType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RecycleGoodAttributeController extends Controller
{
    /**
     * 展示回收商品属性值列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$recyclegoodtype = RecycleGoodType::get();
        $recyclegoodattribute = RecycleGoodAttribute::with('type')->get();
        //dd($recyclegoodattribute);
        return view('Admin.RecycleGoodsAttribute.index',compact('recyclegoodattribute'));
    }

    /**
     * 展示添加一个回收商品属性值页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recyclegoodtype = RecycleGoodType::get();
        return view('Admin.RecycleGoodsAttribute.add',compact('recyclegoodtype'));
    }

    /**
     * 添加一个回收商品属性值到数据库中.
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
            'type_name'=>'required',
            'attr_values'=>'required'
        ];
        $mess = [
            'type_name.required'=>'属性名称必须输入',
            'attr_values.required'=>'参数值必须输入'
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/recyclegoodattribute/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = RecycleGoodAttribute::create($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodattribute')->with('msg','添加成功');
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
     * 编辑一个回收商品属性值
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recyclegoodtype = RecycleGoodType::get();
        $recyclegoodattribute = RecycleGoodAttribute::with('type')->find($id);

        //dd($recyclegoodattribute);
        return view('Admin.RecycleGoodsAttribute.edit',compact('recyclegoodattribute','recyclegoodtype'));
    }

    /**
     * 更新一个回收商品属性值
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token');

        $res = RecycleGoodAttribute::find($id)->update($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodattribute')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
    }

    /**
     * 删除一个回收商品属性值
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = RecycleGoodAttribute::find($id)->delete();
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
