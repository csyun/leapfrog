<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    /**
     * 与前台用户表data_shop_cart关联的模型
     * @author [李瑞宸]
     * @data 2017-11-28 20:00
     * @关联了模型Admin_Goods
     */
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_goods_cart';
    //定义主键  , 默认值就是id
    public $primaryKey = 'gcid';

    // 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 设置允许批量修改的字段
    public $fillable = [];
//    public function Cart()
//    {
//        return $this->hasMany('App\Models\Admin_Goods','gid','uid');
//    }
}
