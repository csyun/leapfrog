<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //模型管理表
    public $table = 'data_cate';
//    定义主键  , 默认值就是id
    public $primaryKey = 'cid';

//    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    public $guarded = [];

    public function relation()
    {
        $cates = $this->orderBy('order','asc')->get();
        return $this->getCate($cates,0);

    }
    public function  getCate($cates,$pid)
    {
        $arr = [];
        foreach ($cates as $k=>$v){
            if($v->pid == $pid)
            {
                $v->cnames = $v->cname;
                $arr[] = $v;
                foreach ($cates as $m => $n){
                    if($n->pid == $v->cid)
                    {
                        $n->cnames = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$n->cname;
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }
}
