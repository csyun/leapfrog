<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommend;
use Illuminate\Support\Facades\Validator;

class RecommendController extends Controller
{
    /**
     * 推荐位列表展示.
     * @auth 曹守云
     * @date 2017/12/04/ 20:00
     * @return 返回推荐位列表视图
     */
    public function index()
    {
        $recommends = Recommend::get();
        return view('Admin\Recommend\index',compact('recommends'));
    }

    /**
     * 展示添加推荐位页面
     * @auth 曹守云
     * @date 2017/12/04 20:30
     * @return 返回添加推荐位视图
     */
    public function create()
    {
        return view('Admin\Recommend\add');
    }

    /**
     * 把添加页面提交的数据存到数据库
     * @auth 曹守云
     * @date 2017/12/05 08:30
     * @param  添加页面提交的数据    \Illuminate\Http\Request  $request
     * @return 操作执行结果   \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except("_token","file_upload");
        //进行表单验证
        $rule = [
            'rname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "status"=>'required',

        ];
        $mess = [
            'rname.required'=>'推荐位名称必须输入',
            'rname.regex'=>'推荐位名称必须是汉字',
            'status.required'=>'状态必须选择',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/recommend/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = Recommend::create($input);
        //判断
        if($res)
        {
            return  redirect('/admin/recommend')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
    }


    public function show($id)
    {

    }

    /**
     * 展示编辑推荐页面
     * @auth 曹守云
     * @date 2017/12/05 9:00
     * @param  要修改的推荐位id int  $id
     * @return 返回编辑页面   \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recommend = Recommend::find($id);
        return view ('Admin/recommend/edit',compact('recommend'));
    }

    /**
     * 储存修改的数据到数据库
     * @auth 曹守云
     * @date 2017/12/05 9:20
     * @param  提交的修改数据  $request
     * @param  要修改id  $id
     * @return 返回操作执行结果
     */
    public function update(Request $request, $id)
    {
        $input = $request->except("_token",'file_upload');
        //进行表单验证
        $rule = [
            'rname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "status"=>'required',

        ];
        $mess = [
            'rname.required'=>'推荐位名称必须输入',
            'rname.regex'=>'推荐位名称必须是汉字',
            'status.required'=>'状态必须选择',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/recommend/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = Recommend::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/recommend')->with('msg','修改成功');;
        }else{
            return back()->with('msg','修改失败');;
        }
    }

    /**
     * 删除一条推荐位记录
     * @auth 曹守云
     * @date 2017/12/05/ 08:40
     * @param  要删除的推荐位id int  $id
     * @return 执行操作结果   \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Recommend::find($id)->delete();
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
