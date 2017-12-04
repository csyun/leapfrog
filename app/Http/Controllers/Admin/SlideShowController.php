<?php

namespace App\Http\Controllers\Admin;

use App\Models\SlideShow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SlideShowController extends Controller
{

    /**
     * 更改录播图列表的排序
     * @auth:caoshouyun
     * @date:2017/12/03 13:00
     * @param request
     * @return:操作结果
     */
    public function changeorder(Request $request)
    {
        $sid = $request->input('sid');
        $order = $request->input('order');
        $slideshow = SlideShow::find($sid);
        $res = $slideshow->update(['order'=>$order]);
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
     * 显示轮播图列表.
     * @auth 曹守云
     * @return 列表视图
     */
    public function index()
    {
        $slideshows = SlideShow::orderBy('order','asc')->get();
        return view('Admin\SlideShow\index',compact('slideshows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\SlideShow\add');
    }

    /**
     * 把添加页面提交的数据存到数据库表.
     * @auth 曹守云
     * @date 2017/12/03 12:45
     * @param  \Illuminate\Http\Request  $request
     * @return 执行操作结果
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        //表单验证规则
        $rule = [
            'slidiesname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "order"=>'required|numeric',

        ];
        $mess = [
            'slidiesname.required'=>'标题必须输入',
            'slidiesname.regex'=>'标题必须是汉字',
            'order.required'=>'排序必须输入',
            'order.numeric'=>'排序必须是数字',

        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/SlideShow/create')
                ->withErrors($validator)
                ->withInput();
        }

        $slidiesname = new SlideShow();
        $res = $slidiesname->create($input);

        //判断
        if($res)
        {
            return  redirect('/admin/slideshow')->with('msg','添加成功');
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

    }

    /**
     * 展示要编辑轮播图的页面带历史数据
     * @auth 曹守云
     * @date 2017/12/03 13:50
     * @param  要修改的数据id  $id
     * @return \Illuminate\Http\Response 视图页面
     */
    public function edit($id)
    {
        $slideshow = SlideShow::find($id);
        return view ('Admin/slideshow/edit',compact('slideshow'));
    }

    /**
     * 储存修改的数据到数据库
     * @auth 曹守云
     * @date 2017/12/03 14:00
     * @param  提交的修改数据  $request
     * @param  要修改id  $id
     * @return 返回操作执行结果
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','file_upload','_method');
        //dd($input);

        //表单验证规则
        $rule = [
            'slidiesname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "order"=>'required|numeric',
        ];
        //提示信息
        $mess = [
            'slidiesname.required'=>'标题必须输入',
            'slidiesname.regex'=>'标题必须是汉字',
            'order.required'=>'排序必须输入',
            'order.numeric'=>'排序必须是数字',

        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/slideshow/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = SlideShow::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/slideshow')->with('msg','修改成功');;
        }else{
            return back()->with('msg','修改失败');;
        }
    }

    /**
     * 删除一条轮播图数据
     * @auth 曹守云
     * @date 2017/12/03 13:30
     * @param  要删除的id  $id
     * @return 返回删除结果
     */
    public function destroy($id)
    {
        $res = SlideShow::find($id)->delete();
        $data = [];
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        //return  json_encode($data);

        return $data;
    }
}
