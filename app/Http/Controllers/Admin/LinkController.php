<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeorder(Request $request)
    {
        $lid = $request->input('lid');
        $order = $request->input('order');
        $link = Link::find($lid);
        $res = $link->update(['order'=>$order]);
        if($res){
            $link =[
                'status'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $link =[
                'status'=> 1,
                'msg'=>'修改失败'
            ];
        }

        return $link;
    }

    public function index()
    {


        $link = link::orderBy('order','asc')->get();
        return view('Admin.Link.index',compact('link'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.Link.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except("_token");

       //进行表单验证
        $rule = [

            'lname'=>'required',
            "url"=>'required',
            "order"=>'required|numeric',
         
        ];

        $mess = [

                'lname.required'=>'友情链接名称必须输入',
                'url.required'=>'网址链接必须填写',
                'order.required'=>'友情链接排序必须填写',
                'order.numeric'=>'友情链接排序必须数字',
        ];


        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/link/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res = link::create($input);
        //判断
        if($res)
        {
            return  redirect('/admin/link')->with('msg','添加成功');
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
        $link = Link::find($id);
        return view ('Admin.Link.edit',compact('link'));
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
        $input = $request->except("_token");
        //进行表单验证
        $rule = [
            'lname'=>'required',
            "url"=>'required',
            "order"=>'required|Numeric',
        ];
        $mess = [
            'lname.required'=>'友情链接名称必须输入',
            'url.required'=>'url地址必须填写',
            'order.required'=>'友情链接排序必须填写',
            'order.Numeric'=>'友情链接排序必须数字',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect("admin/link/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $res = link::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/link')->with('msg','修改成功');; 
        }else{
            return back()->with('msg','修改失败');;
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
        $res = link::find($id)->delete();
        $link = [];
        if($res){
            $link['error'] = 0;
            $link['msg'] ="删除成功";
        }else{
            $link['error'] = 1;
            $link['msg'] ="删除失败";
        }
        return $link;
    }
}
