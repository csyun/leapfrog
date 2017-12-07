<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
 

    /**
     * ajax验证权限名
     * 
     */
    public function ajax(Request $request)
    {
        $data = $request->all();
        $res = Permission::where('pname',$data['pname'])->first();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Permission::orderBy('pid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $pname = $request->input('key');    
                
                //如果用户名不为空
                if(!empty($pname)) {
                    $query->where('pname','like','%'.$pname.'%');
                }
            })
            ->paginate(6);



        return view('Admin/Permission/index',compact('data','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/Permission/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request,[
            'pname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'desc'=>'required|between:4,100',
            
            
        ],[
            'pname.required'=>'权限名不能为空',
            'pname.regex'=>'权限名必须汉字字母下划线',
            'pname.between'=>'权限名必须在2到18位之间',
            'desc.required'=>'描述不能为空',
            'desc.between'=>'描述必须在4到100位之间',
            
        ]);


        //1.获取提交的数据
        $input = $request->except('_token');
        // dd($input);

        //2. 执行添加操作
        $input['desc'] = trim($input['desc']);
        $res = Permission::create($input);


        //3. 如果添加成功跳转到列表页，失败跳转到添加页

        if($res){
            return redirect('/admin/permission')->with('errors','权限添加成功');
        }else{
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
        //根据穿过来的id查找该用户信息
        $user = new Permission();
        $data = $user->find($id);
        

        return view ('Admin/Permission/edit',['data'=>$data]);
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
        //表单验证
        $this->validate($request,[
            'pname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'desc'=>'required|between:4,100',
            
            
        ],[
            'pname.required'=>'角色名不能为空',
            'pname.regex'=>'用户名必须汉字字母下划线',
            'pname.between'=>'用户名必须在2到18位之间',
            'desc.required'=>'描述不能为空',
            'desc.between'=>'描述必须在4到20位之间',           
        ]);

        //去除_token
        $data = $request->except('_token');
        
        //查看本来数据的uname
        $name = Permission::find($id);

        //判断是否有此用户
        $pname = Permission::where('pname',$data['pname'])->first();


        // dd($uname->uname);
        // dd($name->uname);
        //dd($uname && ($uname->uname != $name->uname));
        
        //当用户存在且不为原来的用户名时返回报错
        if ($pname && ($pname->pname != $name->pname)) {
             return redirect('admin/permission/'.$id.'/edit')->with('errors','角色名已存在');
         } 
        //更改用户信息
        $user = Permission::find($id);
        // dd($data);
        $res = $user->update($data);


        //判断
        if($res)
        {
            return redirect('/admin/permission')->with('errors','更改成功');
        }else{
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
        $res = Permission::find($id)->delete();
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
