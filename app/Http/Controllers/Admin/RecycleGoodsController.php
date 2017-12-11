<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoods;
use App\Models\RecycleGoodsAttrValue;
use App\Models\RecycleGoodType;
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
        $recyclegoods = RecycleGoods::with('type')->paginate(4);
        //dd($recyclegoods);
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
        $recyclegoodtype = RecycleGoodType::get();
        $recycleattr = RecycleGoodAttribute::get();
     //   $type_id=$recycleattr->first();
        $types = $recycleattr->map(function ($user) {
            return $user->type_id;
        });

        $type_id = $types[0];
        $recycleattr = RecycleGoodAttribute::where('type_id',$type_id)->get();
        foreach ($recycleattr as $key=>$value){
            if($value->attr_values){
                $attr_values = explode("\r\n",$value->attr_values);
                $recycleattr[$key]['attr_values'] = $attr_values;
            }
        }
        return view('Admin\RecycleGoods\add',compact('recyclegoodtype','recycleattr'));
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
        //dd($input);
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
        $good['rgname'] = $input['rgname'];
        $good['rgprice'] = $input['rgprice'];
        $good['rgpic'] = $input['rgpic'];
        $good['type_id'] = $input['type_id'];
        $res = RecycleGoods::create($good);
        if($res)
        {
            foreach ($input['attr_value'] as $k=>$v)
            {
                $arr['rgid'] = $res->rgid;
                $arr['attr_value'] = $v;
                $arr['attr_price'] = $input['attr_price'][$k];
                $arr['attr_id'] = $input['attr_id'][$k];
                $res = RecycleGoodsAttrValue::create($arr);
            }
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
        $recyclegoodtype = RecycleGoodType::get();
        //获取属性
        $recycleattr = RecycleGoodAttribute::where('type_id',$recyclegood->type_id)->get();
        //获取属性值
        $goodattrvalues = RecycleGoodsAttrValue::where('rgid',$id)->get();
        //处理数据
        $goodattrvalue = [];
        foreach ($goodattrvalues as $k=>$v){
            $attval['attr_value'] =  $v->attr_value;
            $attval['attr_price'] =  $v->attr_price;
            $goodattrvalue[$v->attr_id][] = $attval;
        }

        foreach ($recycleattr as $key=>$value){
            if($value->attr_values){
                $attr_values = explode("\r\n",$value->attr_values);
                $recycleattr[$key]['attr_values'] = $attr_values;
                if($goodattrvalue){
                    $recycleattr[$key]['goodattrvalue'] = $goodattrvalue[$value->attr_id];
                }
            }
        }
        return view('Admin\RecycleGoods\edit',compact('recyclegood','recyclegoodtype','recycleattr'));
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

        RecycleGoodsAttrValue::where('rgid',$id)->delete();
        foreach ($input['attr_value'] as $k=>$v)
        {
            if($input['attr_price'][$k]){
                $arr['rgid'] = $id;
                $arr['attr_value'] = $v;
                $arr['attr_price'] = $input['attr_price'][$k];
                $arr['attr_id'] = $input['attr_id'][$k];
                $res = RecycleGoodsAttrValue::create($arr);
            }
        }
        //dd('1111');
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
        $good = [];
        $good['rgname'] = $input['rgname'];
        $good['rgprice'] = $input['rgprice'];
        $good['rgpic'] = $input['rgpic'];
        $good['type_id'] = $input['type_id'];
        $res = RecycleGoods::find($id)->update($good);
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
    public function getTypes(Request $request)
    {
        $type_id = $request->input('type_id');
        $recycleattr = RecycleGoodAttribute::where('type_id',$type_id)->get();
        $result = [];
        foreach ($recycleattr as $key=>$value){
            $result[$key]['attr_name']= $value->attr_name;
            $result[$key]['attr_id']= $value->attr_id;
            if($value->attr_values){
                $attr_values = explode("\r\n",$value->attr_values);
                $result[$key]['attr_values'] = $attr_values;
            }
        }
        if($result){
            $data =[
                'status'=> 0,
                'msg'=>$result
            ];
        }else{
            $data =[
                'status'=> 1,
                'msg'=>'失败'
            ];
        }

        return $data;
    }
}
