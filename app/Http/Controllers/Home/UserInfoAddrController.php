<?php

namespace App\Http\Controllers\Home;

use App\Models\Addr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class UserInfoAddrController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addrs = Addr::where('uid',Session::get('homeuser.uid'))->get();
       //dd($addrs);
        return view('Home\UserInfo\addr',compact('addrs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $input['uid'] = Session::get('homeuser.uid');
        //dd($input);
        $res = Addr::create($input);
        if ($res){
            return redirect('/userinfo/addr');
        } else{
            return back();
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
       $addr = Addr::find($id);
       //dd($addr);
        return view('Home\UserInfo\editaddr',compact('addr'));
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
        $input = $request->except('_token','_method');
        $res= Addr::find($id)->update($input);
       if ($res)
       {
           return redirect('/userinfo/addr');
       } else{
           return back();
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
        $res = Addr::find($id)->delete();
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
