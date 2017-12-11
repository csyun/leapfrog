<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home_User;
use App\Models\UserInfo;
use App\Models\MarketInfo;
use App\Models\MarketUser;

/**
 *后台蛙塘审查
 * @author [苏波] <386249656@qq.com>
 * @data 2017-12-11 11:00
 * 
 */

class PondController extends Controller
{
	/**
	 * 等待审核的ajax ,wait
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function wait(Request $request)
    {
        $data = $request->all();
        $res = MarketInfo::where('mid',$data['mid'])
        					->update(['status'=>0]);

        if($res){
            return 1;
        }else{
            return 0;
        }
    }   

	 /**
     * 通过审核的passajax
     * 
     */
    public function pass(Request $request)
    {
        $data = $request->all();
        $res = MarketInfo::where('mid',$data['mid'])
        					->update(['status'=>1]);

        if($res){
            return 1;
        }else{
            return 0;
        }
    }

	 /**
     * 没通过审核的notpassajax
     * 
     */
    public function notpass(Request $request)
    {
        $data = $request->all();
        $res = MarketInfo::where('mid',$data['mid'])
        					->update(['status'=>2]);

        if($res){
            return 1;
        }else{
            return 0;
        }
    }    
//=============================================================================
	/**
	 * 等待审核的蛙塘列表
	 * @return [type] [description]
	 */
    public function index(Request $request)
    {	
    	//未审核的蛙塘
    	$data = MarketInfo::orderBy('creat_time','asc')
             ->where(function($query) use($request){
                //检测关键字
                $uname = $request->input('key');
                              
                //如果用户名不为空
                if(!empty($uname)) {
                    $query->where('mname','like','%'.$uname.'%');
                }
            })
            ->where('status','=',0)
            ->paginate(4);
    	return view('Admin/Pond/index',compact('data','request'));
    }

    /**
     * 通过审核的蛙塘列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function passlist(Request $request)
    {	
    	//通过审核的蛙塘
    	$data = MarketInfo::orderBy('creat_time','asc')
             ->where(function($query) use($request){
                //检测关键字
                $uname = $request->input('key');
                              
                //如果用户名不为空
                if(!empty($uname)) {
                    $query->where('mname','like','%'.$uname.'%');
                }
            })
            ->where('status','=',1)
            ->paginate(4);
    	return view('Admin/Pond/passlist',compact('data','request'));
    }

    /**
     * 未通过审核的蛙塘列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notpasslist(Request $request)
    {	
    	//通过审核的蛙塘
    	$data = MarketInfo::orderBy('creat_time','asc')
             ->where(function($query) use($request){
                //检测关键字
                $uname = $request->input('key');
                              
                //如果用户名不为空
                if(!empty($uname)) {
                    $query->where('mname','like','%'.$uname.'%');
                }
            })
            ->where('status','=',2)
            ->paginate(4);
    	return view('Admin/Pond/notpasslist',compact('data','request'));
    }


}
