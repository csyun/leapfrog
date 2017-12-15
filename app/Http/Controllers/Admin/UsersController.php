<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin_User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;


/**
 *后台用户控制器 增删改查
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-27 10:00
 * 
 */

class UsersController extends Controller
{

     /**
     * 返回给用户授角色的页面
     */

    public function auth($id)
    {


        // return  \Route::current()->getActionName();

        //获取当前用户
        $data = Admin_User::find($id);

        //获取所有的角色名

        $roles = Role::get();
        // dd($permissions);

        //获取当前用户已经拥有的角色

        $b = DB::table('data_role_user')->where('uid',$id)->first();
        if (empty($b)){
            $a = [];
        }else{

            $own_role = DB::table('data_role_user')->where('uid',$id)->get(  );
            

            foreach ($own_role as $key => $value) {
                 $a[] = $value->rid;
            }
        }
        // dd($a);



        return view('Admin/Users/auth',compact('data','roles','a'));
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
            DB::table('data_role_user')->where('uid',$id)->delete();
             //给当前角色重新授权


            //2. 将授权数据添加到data_role_permission表中
            if(isset($input['role'])){
                foreach ($input['role'] as $k=>$v){
                    DB::table('data_role_user')->insert(['uid'=>$id,'rid'=>$v]);
                }
            }


        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        //添加成功后，跳转到列表页
        return redirect('admin/users');




    }


    /**
     * Display a listing of the resource.
     *用户列表页
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Admin_User与后台用户表data_admin_user关联的模型
        $data = Admin_User::orderBy('uid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $uname = $request->input('key');
                              
                //如果用户名不为空
                if(!empty($uname)) {
                    $query->where('uname','like','%'.$uname.'%');
                }
            })
            ->paginate(6);

        return view('Admin/Users/index',compact('data','request'));

        
    }

    /**
     * Show the form for creating a new resource.
     *用户添加页
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Users/add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request,[
            'uname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,18',
            'password'=>'required|between:6,18',
            'rpassword'=>'same:password',
            
        ],[
            'uname.required'=>'用户名不能为空',
            'uname.regex'=>'用户名必须汉字字母下划线',
            'uname.between'=>'用户名必须在2到18位之间',
            'password.required'=>'密码不能为空',
            'password.between'=>'密码必须在6到18位之间',
            'rpassword.same'=>'两次密码不一致',
        ]);


        //获取模板传来的数据,去除-token,rpassword 

        $data = $request->except('_token','rpassword');
        // dd($data);
        
        //判断是否有此用户
        $uname = Admin_User::where('uname',$data['uname'])->first();
        // dd($uname);

        if ($uname) {
             return redirect('admin/users/create')->with('errors','此用户已存在');
         } 

        //密码加密
        $data['password'] = Hash::make($data['password']);


        //时间,默认刚注册时就是用户当前最后登录时间
        $time = time();
        $data['last_login_time'] = $time;

  

        //Admin_User与后台用户表data_admin_user关联的模型
        //数据上传给数据库
        $user = new Admin_User();
        $res = $user->create($data);
        // dd($res);

        //判断
        if($res)
        {

            return  redirect('/admin/users')->with('errors','添加成功');
        }else{
            return back()->with('errors','添加失败');
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
     *用户信息修改页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据穿过来的id查找该用户信息
        $user = new Admin_User();
        $data = $user->find($id);
        

        return view ('Admin/Users/edit',['data'=>$data]);

    }

    /**
     * Update the specified resource in storage.
     *执行修改更新操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //表单验证
        $this->validate($request,[
            'uname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,20',           
        ],[
            'uname.required'=>'用户名不能为空',
            'uname.regex'=>'用户名必须汉字字母下划线',
            'uname.between'=>'用户名必须在2到18位之间',         
        ]);

        //去除_token
        $data = $request->except('_token');
        
        //查看本来数据的uname
        $name = Admin_User::find($id);

        //判断是否有此用户
        $uname = Admin_User::where('uname',$data['uname'])->first();


        // dd($uname->uname);
        // dd($name->uname);
        //dd($uname && ($uname->uname != $name->uname));
        
        //当用户存在且不为原来的用户名时返回报错
        if ($uname && ($uname->uname != $name->uname)) {
             return redirect('admin/users/'.$id.'/edit')->with('errors','用户名已存在');
         } 
        //更改用户信息
        $user = Admin_User::find($id);
        $res = $user->update($data);


        //判断
        if($res)
        {
            return redirect('/admin/users')->with('errors','更改成功');
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
        $res = Admin_User::find($id)->delete();
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
