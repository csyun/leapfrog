<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idea = Idea::orderBy('create_time','desc')->paginate(3);

        
        return view('Admin\Idea\index', compact('idea','request') );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin\Idea\add');
    
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
        $input['create_time'] = date('Y-m-d H:i:s');
       // dd($input);
        $res = idea::create($input);
        //判断
        if($res)
        {
            return  redirect('/admin/idea')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
       
    }

    /**2 
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
        $Idea = Idea::find($did);
        return view ('Admin/Idea/edit',compact('Idea'));
        
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

         $res = idea::find($id)->update($input);
        //判断
        if($res)
        {
            return redirect('/admin/idea')->with('msg','修改成功');; 
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
        $res = idea::find($id)->delete();
        $idea = [];
        if($res){
            $idea['error'] = 0;
            $idea['msg'] ="删除成功";
        }else{
            $idea['error'] = 1;
            $idea['msg'] ="删除失败";
        }

        return $idea;
    }


    public function abc(Request $request){
        $input = $request->all();
        // dd();
        // $input = $request->except("_token");
        $input['huifu_time'] = date('Y-m-d H:i:s');
        $res = idea::find($input['did'])->update(['huifu'=>$input['huifu'],'huifu_time'=>$input['huifu_time']]);
        //判断
        if($res)
        {
            return  redirect('/admin/idea')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
        }
    }
}
