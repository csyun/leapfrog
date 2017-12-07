<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin_User;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //如果当前用户有正在执行的路由的权限就放行，没有就给一个没有权限的提示

        //1.获取当前用户执行执行的操作对应的路由对应的控制器的方法

        //当前正在执行的路由对应的控制器的方法名
        //"App\Http\Controllers\Admin\UserController@index"
        $route = \Route::current()->getActionName();
        // dd($route);


    //2.获取当前用户所拥有的权限

    //获取当前用户
        $uid = session('user')->uid;
        // dd($uid);

        $user = Admin_User::find($uid);
        // dd($user);

    //2.1 获取当前用户拥有的角色
        $roles = $user->role;
        // dd($roles);


    //定义一个数组，存放用户拥有的所有权限
          $arr = [];
    //2.2 根据拥有的角色获取权限
        foreach ($roles as $k=>$v){
            // dd($v->permission);
             //根据角色找到相关的权限的数组
            foreach ($v->permission as $m=>$n){
                $arr[] = $n->desc;

            }
        }

    //除权限中重复的记录
        $arr = array_unique($arr);
        // dd($arr);






    //2.3 判断当前路由对应的控制器的方法是否在用户拥有的权限中
    //当前用户拥有的权限
    //array:3 [▼
    //      0 => "App\Http\Controllers\Admin\UserController@create "
    //      1 => "App\Http\Controllers\Admin\IndexController@index "
    //      4 => "App\Http\Controllers\Admin\UserController@index "
    //]


        // 当前请求的路由对应的控制器的方法
        //"App\Http\Controllers\Admin\UserController@index"

        //"App\Http\Controllers\Admin\IndexController@index"
        //dd($route);

        //dd($arr);
        //如果当前路由对应的控制器的方法在用户拥有的权限中，放行；如果不在就提示没有权限
        if(in_array($route,$arr)){
            return $next($request);
        }else{
            return redirect('errors/auth');
        }


    }
}
