<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_Goods;
use App\Models\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{


    public function  gstatus($gid)
    {
        $good = Admin_Goods::find($gid);
        $status = !$good->status;
        $res = $good->update(['status'=>$status]);
        if($res){
            $data =[
                'gg'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
                'gg'=> 1,
                'msg'=>'修改失败'
            ];
        }

        return $data;

    }

    public function upload(Request $request)
    {
//        获取客户端传过来的文件
        $file = $request->file('file_upload');
//        $file = $request->all();
//        dd($file);
//        foreach ($file as $k=>$v) {
            if ($file->isValid()) {
                //        获取文件上传对象的后缀名
                $ext = $file->getClientOriginalExtension();


                //生成一个唯一的文件名，保证所有的文件不重名
                $newfile = time() . rand(1000, 9999) . uniqid() . '.' . $ext;


                //设置上传文件的目录
                $dirpath = public_path() . '/uploads/';


                //将文件移动到本地服务器的指定的位置，并以新文件名命名
//            $file->move(移动到的目录, 新文件名);
                $file->move($dirpath, $newfile);


                //将文件移动到七牛云，并以新文件名命名
                //\Storage::disk('qiniu')->writeStream('uploads/'.$newfile, fopen($file->getRealPath(), 'r'));


                //将文件移动到阿里OSS
//            OSS::upload($newfile,$file->getRealPath());


                //将上传的图片名称返回到前台，目的是前台显示图片
                return $newfile;


            }
//        }

    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $good = Admin_Goods::orderBy('gid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $goodname= $request->input('keywords1');

                if(!empty($goodname)) {
                    $query->where('gname','like','%'.$goodname.'%');
                }


            })
            ->paginate(2);
//        dd($good);
        return view('Admin.Goods.index',compact('good','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = (new Cate())->relation();
        $pid = array_column($cates,'pid');
        $pid = array_unique($pid);
        return view('Admin.Goods.add',compact('cates','pid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
       $rule = [
            'gname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',
            "gprice"=>'required|numeric'
        ];
        $mess = [
            'gname.required'=>'商品名称名称必须输入',
            'gname.regex'=>'商品名称不合法',
            'gprice.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格不合法',
        ];
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/goods/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $good = new Admin_Goods();
        $good->gname = $data['gname'];
        $good->cid= $data['cid'];
        $good->status = $data['status'];
        $good->gprice = $data['gprice'];
        $good->gpurl = $data['gpurl'];
        $good->gdesc= $data['gdesc'];
        $row = $good->save();
        if($row){
            return redirect('admin/goods')->with('msg','添加成功');
        }else{
            return redirect('admin/goods/create');
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

       $good = Admin_Goods::find($id);
       $cates = (new Cate())->relation();
       $pid = array_column($cates,'pid');
       $pid = array_unique($pid);
       return view('Admin.Goods.edit',compact('good','cates','pid'));
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
        $input = $request->except('_token');
        $good = Admin_Goods::find($id);
        $rule = [
            'gname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',
            "gprice"=>'required|numeric'
        ];
        $mess = [
            'gname.required'=>'商品名称名称必须输入',
            'gname.regex'=>'商品名称不合法',
            'gprcie.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格不合法',
        ];
        $validator =  Validator::make($input,$rule,$mess);
        if ($validator->fails()) {
            return redirect('admin/goods/'.$good->gid.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $res = $good->update($input);
        if($res){
            return redirect('admin/goods')->with('msg','修改成功');
        }else{
            return redirect('admin/goods'.$good->gid.'/edit');
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
        $res = Admin_Goods::find($id)->delete();
        $data = [];
        if ($res) {
            $data['gg'] = 0;
            $data['msg'] = "删除成功";
        } else {
            $data['gg'] = 1;
            $data['msg'] = "删除失败";
        }
        return $data;
    }
}
