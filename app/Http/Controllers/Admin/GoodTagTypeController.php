<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodTagType;
use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GoodTagTypeController extends Controller
{
    /**
     * 展示标签类型类别.
     * @auth 曹守云
     * @date 2017/12/02 18:00
     * @return 返回标签类型列表视图页面
     */
    public function index()
    {
        //获取分类
        $tagstype = GoodTagType::get();
        foreach ($tagstype as $k=>$v){
            if($v->cid){
                $cid = explode(',',$v->cid);
                $cnames =  Cate::wherein('cid',$cid)->get(['cname'])->toArray();
                $tagstype[$k]['cnames'] = implode(',',array_column($cnames,'cname'));
            }
        }

        //$cate =  Cate::wherein('cid',[1,2,3,4])->get();
       // dd($cate);
        return view('Admin\GoodTagType\index',compact('tagstype'));
    }

    /**
     * 商品标签类型添加页面.
     * @auth 曹守云
     * @date 2017/12/02 18:30
     * @return 返回标签类型添加页面
     */
    public function create()
    {
        $cates = Cate::get();

        //dd($cates);
        return view('Admin\GoodTagType\add',compact('cates'));
    }

    /**
     * 把标签添加页面提交的数据存到数据库
     * @auth 曹守云
     * @date 2017/12/02 19:00
     * @param  $request
     * @return 执行结果
     */
    public function store(Request $request)
    {
        $checkbox = $request->input('cid');
        if (is_array($checkbox)){
            $cid = implode(',',$checkbox);
        } else{
            $cid = $checkbox;
        }

        $input['cid'] = $cid;
        $input['tag_type'] = $request->input('tag_type');
        //dd($input);
        //表单验证规则
        $rule = [
            'tag_type'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
        ];
        $mess = [
            'tag_type.required'=>'标签类型必须输入',
            'tag_type.regex'=>'标题必须是汉字',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/goodtagtype/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = GoodTagType::create($input);
        if($res)
        {
            return  redirect('/admin/goodtagtype')->with('msg','添加成功');
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
        $goodtagtype = GoodTagType::find($id);
        $cates = Cate::get();
        $cids = explode(',',$goodtagtype->cid);

        return view ('Admin/goodtagtype/edit',compact('cates','goodtagtype','cids'));
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
        $checkbox = $request->input('cid');
        if (is_array($checkbox)){
            $cid = implode(',',$checkbox);
        } else{
            $cid = $checkbox;
        }

        $input['cid'] = $cid;
        $input['tag_type'] = $request->input('tag_type');
        //dd($input);
        //表单验证规则
        $rule = [
            'tag_type'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
        ];
        $mess = [
            'tag_type.required'=>'标签类型必须输入',
            'tag_type.regex'=>'标题必须是汉字',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/goodtagtype/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = GoodTagType::find($id)->update($input);
        if($res)
        {
            return  redirect('/admin/goodtagtype')->with('msg','更新成功');
        }else{
            return back()->with('msg','更新失败');
        }
    }

    /**
     * 删除一个分类标签
     * @auth    曹守云
     * @date 2017/12/02 21:30
     * @param  要删除标签的id  $id
     * @return 执行删除的结果
     */
    public function destroy($id)
    {
        $res = GoodTagType::find($id)->delete();
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
