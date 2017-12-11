<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class CodeController extends Controller
{
    /**
     * 功能:生成验证码
     * @author caoshouyun
     * @date(2017/11/29 9:00)
     * @return 一张图片
     */
    public function code()
    {
        $builder = new CaptchaBuilder;
        $builder->build(200,40);
        Session::put('phrase',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }
}
