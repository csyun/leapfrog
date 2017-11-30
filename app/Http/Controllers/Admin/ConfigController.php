<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_config;


class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        $configs=(new data_config())::first();
         return view('Admin\Config\config',['configs'=>$configs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return 111;
        return view('Admin\Config\config');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function ajaxtel(Request $request)
    {
        dd(2345);
        sleep(2);
        // $id = $request->input('id');
       

        $res = \DB::table('data_config')->where('tel', $tel)->first();
        if($res)
        {
//            用户名已经存在 。
            return response()->json(['code' => 0]);
        }else{
            $r = \DB::table('data_config')->where("cid", 1)->update(['tel' => $tel]);
            if($r)
            {
//                1.表示成功。
                return response()->json(['code' => 1]);
            }else{
//                2.表示失败。
                return response()->json(['code' => 2]);
            }
        }
    }
}
