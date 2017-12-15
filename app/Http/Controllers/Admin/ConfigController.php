f<?php


namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ConfigController extends Controller
{

    /**
     * 网站配置展示.
     *@auth 李丹丹
    
     * @return \返回配置列表视图
     */
        public function changeorder(Request $request)
        {
            $conf_id = $request->input('config_id');
            $conf_order = $request->input('config_order');
            $data = Config::find($conf_id);
            $res = $data->update(['conf_order'=>$conf_order]);
           
            $arr = [];
            if($res){               
                $data =[
                    'status'=> 0,
                    'msg'=>'修改成功'
                ];

             }else{
                
                $data =[
                    'status'=> 1,
                    'msg'=>'修改失败'
                ];
            }

            return $data;
        }

        public function PutFile()
        {

            // 1 获取网站配置表中的数据
            $conf = config::pluck('conf_content','conf_name')->all();
            
            // 2 创建网站配置文件，写入数据
            //配置文件的文件名
            $filename = config_path().'\webconfig.php';
            //数据库中查到的数据是数组形式，变成字符串形式
            $context ="<?php return \n".var_export($conf,true).';';
    
            file_put_contents($filename,$context);
            
        }
        
        /**
         * 批量修改网站配置内容
         */

        public function ContentChange(Request $request)
        {

            $input = $request->all();
            // //进行表单验证
            // $rule = [

            //   "conf_content"=>'required',
          
            //  ];

            // $mess = [

            //     'conf_content.required'=>'网站配置内容必须填写',
                
            // ];

            // $validator =  Validator::make($input,$rule,$mess);
            // if ($validator->fails()) {
            //     return redirect('admin/config/create')
            //         ->withErrors($validator)
            //         ->withInput();
            //  }

            //根据conf_id数组获取要修改的网站配置记录，然后从conf_content的同下标中取出此网站配置记录要修改成的值

            foreach ($input['conf_id'] as $k=>$v){
             
             $new_content = $input['conf_content'][$k];
              DB::table('data_config')->where(['conf_id'=>$v])->update(['conf_content'=> $new_content]);
              
            }

            return redirect('admin/config');
        }
        
        /**
         * 显示资源列表
         *
         * @return \Illuminate\Http\Response
         */
        
        public function index()
        {
            //网站配置数据
            $config = config::orderBy('conf_order','asc')->get();
            // dd($config);

            foreach ($config as $k=>$v){
            //根据当前这条记录的field_type字段的值类决定，conf_content的显示形式
            // dd($v->conf_content);
                switch ($v->field_type){
                    case 'input':
                        //<input type="text" name="conf_title">
                        $v->conf_contents = '<input class="lg" type="text" style="background:#4B5357" name="conf_content[]" value="'.htmlspecialchars($v->conf_content).'">';

                        break;

                    case 'textarea':
                   
                        $v->conf_contents = '<textarea style="background:#4B5357" cols="30" rows="5" name="conf_content[]">'.htmlspecialchars($v->conf_content).'</textarea>';

                        break;

                    case 'radio':

                        $str = '';

                        $arr = explode(',',$v->field_value);
                        foreach ($arr as $m=>$n){

                          $item = explode('|',$n);
                          //如果当前网站配置记录的conf_content的值 == 单选按钮的值，应该给单选按钮添加checked属性
                            if($item[0] == $v->conf_content){
                                $str.= '<input type="radio" checked name="conf_content[]" value="'.$item[0].'" >'.$item[1];
                            }else{
                                $str.= '<input type="radio"  name="conf_content[]" value="'.$item[0].'" >'.$item[1];
                            }

                        }

                        $v->conf_contents = $str;

                        break;
                }

            }

            return view('admin.config.list',compact('config'));
        }


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            
            return view('admin.config.add');
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

            //进行表单验证
            $rule = [

                    'conf_title'=>'required',
                    "conf_name"=>'required',
                    "conf_content"=>'required',
                    "conf_order"=>'required|Numeric',
                    "conf_tips"=>'required',
                    // "conf_type"=>'required',


            ];

            $mess = [

                    'conf_title.required'=>'标题名称必须输入',
                    'conf_name.required'=>'配置名称必须输入',
                    'conf_content.required'=>'网址配置内容必须填写',
                    'conf_order.required'=>'配置序号必须填写',
                    'conf_order.numeric'=>'配置序号必须数字',
                    'conf_tips.required'=>'网站配置说明必须输入',
                    // 'conf_type.required'=>'网站配置类型必须输入',
            ];

            $validator =  Validator::make($input,$rule,$mess);
            if ($validator->fails()) {
                return redirect('admin/config/create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $res = Config::create($input);
           
            if($res){
                $this->PutFile();
                return redirect('admin/config');
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

            $config = Config::find($id);
            return view ('Admin.config.edit',compact('config'));
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
        
            //进行表单验证
            $rule = [

            'conf_title'=>'required',
            "conf_name"=>'required',
            "conf_content"=>'required',
            "conf_order"=>'required|Numeric',
            
            ];

             $mess = [

            'conf_title.required'=>'标题名称必须输入',
            'conf_name.required'=>'配置名称必须输入',
            'nav_content.required'=>'网址配置内容必须填写',
            'nav_order.required'=>'配置序号必须填写',
            'nav_order.numeric'=>'配置序号必须数字',
                
            ];

            $validator =  Validator::make($input,$rule,$mess);
            if ($validator->fails()) {
                return redirect('admin/config/create')
                    ->withErrors($validator)
                    ->withInput();
            }


            $res = Config::find($id)->update($input);
       
            if($res){
                return redirect('admin/config')->with('msg','修改成功');
            }else{
                return back()->with('msg','修改失败');
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
            $res = config::find($id)->delete();
            $data = [];
            if($res){
                $data['error'] = 0;
                $data['msg'] ="删除成功";
            }else{
                $data['error'] = 1;
                $data['msg'] ="删除失败";
            }
            return $data;
        }
}
