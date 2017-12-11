<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    /**
     * 与前台用户表data_cate关联的模型
     * @author [李瑞宸]
     * @data 2017-11-28 20:00
     * @关联了模型Admin_Goods
     */
    //模型管理表
    public $table = 'data_cate';
//    定义主键  , 默认值就是id
    public $primaryKey = 'cid';

//    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    public $guarded = [];

    public function relation($pid=0,$lev=0)
    {
        $cates = $this->orderBy('order','asc')->get();

       return $this->getCate($cates,$pid,$lev);


    }
    public function  getCate($cates,$pid,$lev)
    {
        $arr = [];
        foreach ($cates as $k=>$v){
            if($v->pid==$pid){
                $v->lev = $lev;
                $arr[] = $v;
                $arr = array_merge($arr,$this->getCate($cates,$v->cid,$lev+1));
            }
        }
        return $arr;
    }
}
