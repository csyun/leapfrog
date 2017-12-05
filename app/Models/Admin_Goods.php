<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin_Goods extends Model
{
    public $table = 'data_goods';
//    定义主键  , 默认值就是id
    public $primaryKey = 'gid';

//    定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    public $guarded = [];
}
