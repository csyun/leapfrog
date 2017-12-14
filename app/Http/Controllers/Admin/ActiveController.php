<?php

namespace App\Http\Controllers\Admin;

use App\Models\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeorder(Request $request)
    {
        $aid = $request->input('aid');
        $order = $request->input('order');
        $adver = Active::find($aid);
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



    public function index()
    {
        $actives = active::orderBy('order','asc')->get();
        return view('Admin\Active\index',compact('actives'));
        //return view('Admin\Active\index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\Active\add');
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

        $res = Active::create($input);
        if($res)
        {
            return  redirect('/admin/active')->with('msg','添加成功');
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
        $active = Active::find( $id);
        return view ('Admin/active/edit',compact('active'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Active::find($id)->delete();
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
