<?php

namespace App\Http\Middleware;

use Closure;
use Session;

/**
 *前台用户是否登录中间件
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-2 9:00
 * 
 */

class HomeLogin
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
        // 如果用户登录了就放行，如果没有登录就拦住返回到登录页面
        if(Session::get('homeuser')){
            return $next($request);
        }else{
            $a = url()->current();
            Session::put('back',$a);
            return redirect('/login')->with('errors','未登录请先登录');
        }
    }
}
