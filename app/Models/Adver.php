<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 与广告位data_adver表关联
 * @auth:caoshouyun
 * @date:2017/12/05 09:40
 */
class Adver extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_adver';
    //定义主键  , 默认值就是id
    public $primaryKey = 'aid';

    // 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 不允许批量修改的字段
    public $guarded = [];
}
