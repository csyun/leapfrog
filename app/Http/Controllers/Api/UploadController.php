<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OSS;

class UploadController extends Controller
{
    /**
     *处理传过来的图片,上传到阿里云oss
     */
    public function upload(Request $request)
    {
        // 获取客户端传过来的文件
        $file = $request->file('file_upload');


        if($file->isValid()){
            // 获取文件上传对象的后缀名
            $ext = $file->getClientOriginalExtension();

            //生成一个唯一的文件名，保证所有的文件不重名
            $newfile = time().rand(1000,9999).uniqid().'.'.$ext;
            //将上传的图片上传到阿里云  leapfrog.oss-cn-beijing.aliyuncs.com/
            OSS::publicUpload('leapfrog', $newfile, $file->getRealPath());

            //将上传的图片名称返回到前台，目的是前台显示图片
            return $newfile;

        }

    }
}
