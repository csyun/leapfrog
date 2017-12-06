<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdverController extends Controller
{

    /**
     * 更改广告图列表的排序
     * @auth:caoshouyun
     * @date:2017/12/05 9:50
     * @param request
     * @return:操作结果
     */
    public function changeorder(Request $request)
    {
        $aid = $request->input('aid');
        $order = $request->input('order');
        $adver = Adver::find($aid);
        $res = $adver->update(['order'=>$order]);
        if($res){
            $data =[
                'status'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
                'status'=> 1,
                'msg'=>'修改失败'
            ];
        }

        return $data;
    }

    /**
     * 展示广告位列表
     * @auth 曹守云
     * @return 返回展示广告位列表视图  \Illuminate\Http\Response
     */
    public function index()
    {
        $advers = Adver::orderBy('order','asc')->get();
        return view('Admin\Adver\index',compact('advers'));
    }

    /**
     * 展示一个添加页面.
     * @auth 曹守云
     * @return 返回添加页面视图
     */
    public function create()
    {
        return view('Admin\Adver\add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        //表单验证规则
        $rule = [
            'aname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "order"=>'required|numeric',

        ];
        $mess = [
            'aname.required'=>'广告名称必须输入',
            'aname.regex'=>'广告名称必须是汉字',
            'order.required'=>'排序必须输入',
            'order.numeric'=>'排序必须是数字',

        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/adver/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = Adver::create($input);
        if($res)
        {
            return  redirect('/admin/adver')->with('msg','添加成功');
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
     * 展示要编辑轮播图的页面带历史数据
     * @auth 曹守云
     * @date 2017/12/05 10:15
     * @param  要修改的数据id  $id
     * @return \Illuminate\Http\Response 视图页面
     */
    public function edit($id)
    {
        $adver = Adver::find($id);
        return view ('Admin/adver/edit',compact('adver'));
    }

    /**
     * 储存修改的数据到数据库
     * @auth 曹守云
     * @date 2017/12/03 10:20
     * @param  提交的修改数据  $request
     * @param  要修改id  $id
     * @return 返回操作执行结果
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','file_upload');
        //表单验证规则
        $rule = [
            'aname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "order"=>'required|numeric',

        ];
        $mess = [
            'aname.required'=>'广告名称必须输入',
            'aname.regex'=>'广告名称必须是汉字',
            'order.required'=>'排序必须输入',
            'order.numeric'=>'排序必须是数字',

        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/adver/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = Adver::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/adver')->with('msg','修改成功');;
        }else{
            return back()->with('msg','修改失败');;
        }
    }

    /**
     * 删除一条轮播图数据
     * @auth 曹守云
     * @date 2017/12/05 10:10
     * @param  要删除的id  $id
     * @return 返回删除结果
     */
    public function destroy($id)
    {
        $res = Adver::find($id)->delete();
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
