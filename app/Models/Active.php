<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    /**
     * 
     * @author [李丹丹]
     * 
     * @
     */
    //模型管理表
    public $table = 'data_active';
//    定义主键  , 默认值就是id
    public $primaryKey = 'aid';

//    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    public $guarded = [];

    public function relation($pid=0,$lev=0)
    {
        $actives = $this->orderBy('order','asc')->get();

       return $this->getActive($actives,$pid,$lev);


    }
    public function  getActive($actives,$pid,$lev)
    {
        $arr = [];
        foreach ($actives as $k=>$v){
            if($v->pid==$pid){
                $v->lev = $lev;
                $arr[] = $v;
                $arr = array_merge($arr,$this->getActive($actives,$v->cid,$lev+1));
            }
        }
        return $arr;
    }
}
