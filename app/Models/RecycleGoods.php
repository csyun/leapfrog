<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecycleGoods extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_recycle_goods';
    //定义主键  , 默认值就是id
    public $primaryKey = 'rgid';

    // 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 不允许批量修改的字段
    public $guarded = [];
    //关联回收商品模型,多对一关系
    public function goodinfo()
    {
        return $this->belongsTo('App\Models\RecycleGoods');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\RecycleGoodType','type_id');
    }
    public function attrvalue()
    {
        //return $this->belongsTo('App\Models\RecycleGoodAttribute','type_id');
        return $this->hasManyThrough('App\Models\RecycleGoodType', 'App\Models\RecycleGoodAttribute','type_id', 'type_id');
    }
}
