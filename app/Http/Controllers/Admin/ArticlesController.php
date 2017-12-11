<?php

namespace App\Http\Controllers\Admin;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    /**
     * 更改文章列表的排序
     * @auth:caoshouyun
     * @date:2017/12/02 13:00
     * @param request
     * @return:操作结果
    */
    public function changeorder(Request $request)
    {
        $aid = $request->input('aid');
        $number = $request->input('number');
        $articles = Articles::find($aid);
        $res = $articles->update(['number'=>$number]);
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
     * 显示文章列表页面.
     * @auth:曹守云
     * @date:2017/12/01 10:30
     * @return 返回视图文章列表页面
     */
    public function index(Request $request)
    {
        //Articles与后台用户表data_articles关联的模型
        $articles = Articles::orderBy('number','asc')
            ->where(function($query) use($request){
                //检测关键字
                $title = $request->input('keywords');

                //如果关键字不为空
                if(!empty($title)) {
                    $query->where('title','like','%'.$title.'%');
                }
            })
            ->paginate(5);
        return view('Admin\Articles\list',compact('articles','request'));
    }

    /**
     * 显示添加文章页面.
     * @auth:曹守云
     * @date:2017/12/01 9:00
     * @return 返回视图页面
     */
    public function create()
    {
        return view('Admin\Articles\add');
    }

    /**
     * 把表单提交的数据保存到数据库中
     * @auth:caoshouyun
     * @date:2017/12/02 11:00
     * @param  \Illuminate\Http\Request  $request
     * @return 执行结果
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','file_upload');
        //表单验证规则
        $rule = [
            'title'=>'required',
            "content"=>'required',
            "auth"=>'required',
            "number"=>'required|numeric',
            "content"=>'required',
        ];
        $mess = [
            'title.required'=>'标题必须输入',

            'number.required'=>'排序必须输入',
            'number.numeric'=>'排序必须是数字',
            'content.required'=>'内容必须输入',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/articles/create')
                ->withErrors($validator)
                ->withInput();
        }
        $input['create_time']=time();
        $article = new Articles();
        $res = $article->create($input);

        //判断
        if($res)
        {
            return  redirect('/admin/articles')->with('msg','添加成功');
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
     * 编辑文章内容
     * @auth 曹守云
     * @date:2017/12/02 13:40
     * @param  要编辑的文章id
     * @return 编辑视图页面
     */
    public function edit($id)
    {
        $article = Articles::find($id);
        return view ('Admin/articles/edit',['data'=>$article]);
    }

    /**
     * 实现文章内容编辑更新
     * @auth 曹守云
     * @date 2017/12/02 16:40
     * @param  编辑表单提交的数据REQUEST和要编辑的id
     * @return 编辑执行结果
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','file_upload','_method');
        //dd($input);

        //表单验证规则
        $rule = [
            'title'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "content"=>'required',
            "auth"=>'required',
            "number"=>'required|numeric',
            "content"=>'required',
        ];
        //提示信息
        $mess = [
            'title.required'=>'标题必须输入',
            'title.regex'=>'标题必须是汉字',
            'number.required'=>'排序必须输入',
            'number.numeric'=>'排序必须是数字',
            'content.required'=>'内容必须输入',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/articles/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }


        $res = Articles::find($id)->update($input);



        //判断
        if($res)
        {
            return redirect('/admin/articles')->with('msg','修改成功');;
        }else{
            return back()->with('msg','修改失败');;
        }

        //return redirect('/admin/articles',compact('data'));
    }

    /**
     * 删除一条文章
     * @auth    曹守云
     * @date 2017/12/02 13:30
     * @param  要删除文章的id  $id
     * @return 执行删除的结果
     */
    public function destroy($id)
    {
        $res = Articles::find($id)->delete();
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
