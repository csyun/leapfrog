<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CateController extends Controller
{
    public function changeorder(Request $request)
    {
        $cid = $request->input('cid');
        $order = $request->input('order');
        $cate = Cate::find($cid);
        $res = $cate->update(['order'=>$order]);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cate = (new Cate())->relation();

        return view('Admin.Cate.index',compact('cate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::where("pid","0")->get();
        return view('Admin.Cate.add',compact('cate'));
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
        $rule = [
            'cname'=>'required|regex:/^[\x{4e00}-\x{9fa5}_]+$/u',
            "order"=>'required|numeric'
        ];
        $mess = [
            'cname.required'=>'分类名称必须输入',
            'cname.regex'=>'分类必须是汉字',
            'order.required'=>'排序必须输入',
            'order.numeric'=>'排序必须是数字',
        ];

        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/cate/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $cate = new Cate();
        $cate->pid = $data['pid'];
        $cate->cname = $data['cname'];
        $cate->order = $data['order'];
        $row = $cate->save();
        if($row){
            return redirect('admin/cate')->with('msg','添加成功');
        }else{
            return redirect('admin/cate/create');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Cate::find($id);
        return view('Admin.Cate.edit',compact('cate'));
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
        $cate = Cate::find($id);
        $input = $request->only('cname');
        $res = $cate->update($input);
        if($res){
            return redirect('admin/cate')->with('msg','修改成功');
        }else{
            return redirect('admin/cate'.$cate->cid.'/edit');
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
        $noDel = Cate::where('pid', $id)->first();
        if ($noDel) {
            $data['error'] = 3;
            $data['msg'] = "您的下面有分类不能删除";
       } else {
            $res = Cate::find($id)->delete();
            $data = [];
            if ($res) {
                $data['error'] = 0;
                $data['msg'] = "删除成功";
            } else {
                $data['error'] = 1;
                $data['msg'] = "删除失败";
            }
        }
        return $data;
    }

}
