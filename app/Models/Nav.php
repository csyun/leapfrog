<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_nav';
	//定义主键  , 默认值就是id
    public $primaryKey = 'nav_id';

	// 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 设置允许批量修改的字段
    // public $fillable = ['username','userpass','telephone'];

    // 不允许批量修改的字段
   	public $guarded = [];
}
