<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    /**
     * 与前台用户表data_cate关联的模型
     * @author [李瑞宸]
     * @data 2017-12-10 20:00
     * @关联了模型Admin_Goods
     */
    //模型管理表
    public $table = 'data_order_details';
//    定义主键  , 默认值就是id
    public $primaryKey = 'did';

//    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    public $guarded = [];

    public function goods()
    {
        return $this->belongsTo('App\Models\Admin_Goods','gid');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order','oid');
    }

}
