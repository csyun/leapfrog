<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nav;
use Illuminate\Support\Facades\Validator;


class NavController extends Controller
{
    /**
     * 导航列表展示.
     *@auth 李丹丹
     *date 2017/12/05/ 20:00
     * @return \返回导航列表视图
     */
    public function changeorder(Request $request)
    {
        $nav_id = $request->input('nav_id');
        $nav_order = $request->input('nav_order');
        $data = Nav::find($nav_id);
        $res = $data->update(['nav_order'=>$nav_order]);
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


    public function index()
    {
        $nav = Nav::orderBy('nav_order','asc')->get();
        return view('Admin\Nav\index',compact('nav'));
    }

    /**
     * 展示添加导航页面
     *@auth李丹丹
     *date 2017/12/04 20:00
     * @return 返回添加导航视图
     */
    public function create()
    {
        return view('Admin\Nav\add');
    }

    /**
     * 把添加页面提交的数据存入数据库
     *@auth 李丹丹
     *date 2017/12/05/ 20:00
     *param 添加页面提交的数据 \Illuminate\Http\Request $request
     * @return 操作执行结果 \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except("_token");
        //进行表单验证
        $rule = [

            'nav_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "nav_url"=>'required|URL',
           "nav_order"=>'required|Numeric',

        ];

        $mess = [

                'nav_name.required'=>'导航名称必须输入',
                'nav_name.regex'=>'导航名称必须是汉字',
                'nav_url.required'=>'网址链接必须填写',
                'nav_order.required'=>'导航排序必须填写',
                'nav_order.Numeric'=>'导航排序必须数字',
                'nav_url.URL'=>'导航地址必须是有效的URL格式',
        ];


        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/nav/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = Nav::create($input);
        //判断
        if($res)
        {
            return  redirect('/admin/nav')->with('msg','添加成功');
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
     * 展示编辑导航页面
     * @auth 李丹丹
     * @date 2017/12/05 8:40
     * @param  要修改的导航链接
     * @return 返回编辑页面   \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nav = Nav::find($id);
        return view ('Admin/Nav/edit',compact('nav'));
    }

    /**
     * 储存修改的数据到数据库
     * @auth 李丹丹
     * @date 2017/12/05 8:50
     * @param  提交的修改数据  $request
     * @param  要修改id  $id
     * @return 返回操作执行结果
     */
    public function update(Request $request, $id)
    {
        $input = $request->except("_token");
        //进行表单验证
        $rule = [
            'nav_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "nav_url"=>'required|URL',
            "nav_order"=>'required|Numeric',

        ];
        $mess = [
            'nav_name.required'=>'导航名称必须输入',
            'nav_name.regex'=>'导航名称必须是汉字',
            'nav_url.required'=>'url地址必须填写',
            'nav_url.URL'=>'导航地址必须是有效的URL格式',
            'nav_order.required'=>'导航排序必须填写',
            'nav_order.Numeric'=>'导航排序必须数字',
            
            
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/nav/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = nav::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/nav')->with('msg','修改成功');; 
        }else{
            return back()->with('msg','修改失败');;
        }
    }

    /**
     * 删除一条推荐位记录
     * @auth 李丹丹
     * @date 2017/12/05/ 20:56
     * @param  要删除的推荐位id int  $id
     * @return 执行操作结果   \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = nav::find($id)->delete();
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
