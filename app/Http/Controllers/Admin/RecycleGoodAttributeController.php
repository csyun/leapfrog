<?php

namespace App\Http\Controllers\Admin;

use App\Models\RecycleGoodAttribute;
use App\Models\RecycleGoodType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecycleGoodAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$recyclegoodtype = RecycleGoodType::get();
        $recyclegoodattribute = RecycleGoodAttribute::with('type')->get();
        //dd($recyclegoodattribute);
        return view('Admin\RecycleGoodsAttribute\index',compact('recyclegoodattribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recyclegoodtype = RecycleGoodType::get();
        return view('Admin\RecycleGoodsAttribute\add',compact('recyclegoodtype'));
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
        //dd($input);
        //表单验证规则
//        $rule = [
//            'type_name'=>'required'
//        ];
//        $mess = [
//            'type_name.required'=>'名称必须输入'
//        ];
//
//        $validator =  Validator::make($input,$rule,$mess);
//        if ($validator->fails()) {
//            return redirect('admin/recyclegoodtype/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
        $res = RecycleGoodAttribute::create($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodattribute')->with('msg','添加成功');
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
        $recyclegoodtype = RecycleGoodType::get();
        $recyclegoodattribute = RecycleGoodAttribute::with('type')->find($id);

        //dd($recyclegoodattribute);
        return view('Admin\RecycleGoodsAttribute\edit',compact('recyclegoodattribute','recyclegoodtype'));
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
        $input = $request->except('_token');

        $res = RecycleGoodAttribute::find($id)->update($input);
        if($res)
        {
            return  redirect('/admin/recyclegoodattribute')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
        $res = RecycleGoodAttribute::find($id)->delete();
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
