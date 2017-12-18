<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{
     /**
     * 返回给角色授权的页面
     */

    public function auth($id)
    {


        // return  \Route::current()->getActionName();

        //获取当前角色
        $data = Role::find($id);

        //获取所有的权限

        $permissions = Permission::get();
        // dd($permissions);

        //获取当前角色已经拥有的权限
        $b = DB::table('data_role_permission')->where('rid',$id)->first();
        if (empty($b)){
            $a = [];
        }else{

            $own_permissions = DB::table('data_role_permission')->where('rid',$id)->get();
            

            foreach ($own_permissions as $key => $value) {
                 $a[] = $value->pid;
            }
        }
        // dd($a);



        return view('Admin.Role.auth',compact('data','permissions','a'));
    }

     /**
     * 处理用户授权操作
     */

    public function doauth(Request $request,$id)
    {
        //1 接受用户提交的所有数据
        $input = $request->except('_token');
        // dd($input);


        DB::beginTransaction();

        try{
            //删除角色以前拥有的权限
            DB::table('data_role_permission')->where('rid',$id)->delete();
             //给当前角色重新授权


            //2. 将授权数据添加到data_role_permission表中
            if(isset($input['permiss'])){
                foreach ($input['permiss'] as $k=>$v){
                    DB::table('data_role_permission')->insert(['rid'=>$id,'pid'=>$v]);
                }
            }


        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        //添加成功后，跳转到列表页
        return redirect('admin/role');




    }


    /**
     * ajax验证角色名
     * 
     */
    public function ajax(Request $request)
    {
        $data = $request->all();
        $res = Role::where('rname',$data['rname'])->first();
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
       //获取所有的角色
 
         $data = Role::orderBy('rid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $rname = $request->input('key');    
                
                //如果用户名不为空
                if(!empty($rname)) {
                    $query->where('rname','like','%'.$rname.'%');
                }
            })
            ->paginate(6);



        return view('admin.role.index',compact('data','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
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
            'rname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'desc'=>'required|between:4,20',
            
            
        ],[
            'rname.required'=>'角色名不能为空',
            'rname.regex'=>'角色名必须汉字字母下划线',
            'rname.between'=>'角色名必须在2到18位之间',
            'desc.required'=>'描述不能为空',
            'desc.between'=>'描述必须在4到20位之间',
            
        ]);


        //1.获取提交的数据
        $input = $request->except('_token');
        // dd($input);

        //2. 执行添加操作

        $res = Role::create($input);


        //3. 如果添加成功跳转到列表页，失败跳转到添加页

        if($res){
            return redirect('/admin/role')->with('errors','添加角色成功');
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
        $user = new Role();
        $data = $user->find($id);
        

        return view ('Admin.Role.edit',['data'=>$data]);
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
            'rname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'desc'=>'required|between:4,20',
            
            
        ],[
            'rname.required'=>'角色名不能为空',
            'rname.regex'=>'用户名必须汉字字母下划线',
            'rname.between'=>'用户名必须在2到18位之间',
            'desc.required'=>'描述不能为空',
            'desc.between'=>'密码必须在4到20位之间',           
        ]);

        //去除_token
        $data = $request->except('_token');
        
        //查看本来数据的uname
        $name = Role::find($id);

        //判断是否有此用户
        $rname = Role::where('rname',$data['rname'])->first();


        // dd($uname->uname);
        // dd($name->uname);
        //dd($uname && ($uname->uname != $name->uname));
        
        //当用户存在且不为原来的用户名时返回报错
        if ($rname && ($rname->rname != $name->rname)) {
             return redirect('admin/role/'.$id.'/edit')->with('errors','角色名已存在');
         } 
        //更改用户信息
        $user = Role::find($id);
        // dd($data);
        $res = $user->update($data);


        //判断
        if($res)
        {
            return redirect('/admin/role')->with('errors','更改成功');
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
        
        $res = Role::find($id)->delete();
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
