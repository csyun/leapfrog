<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_role';
	//定义主键  , 默认值就是id
    public $primaryKey = 'rid';

	// 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 设置允许批量修改的字段
    // public $fillable = [];

    // 不允许批量修改的字段
   	public $guarded = [];

    public function admin_users()
    {
        return $this->belongsToMany('App\Models\Admin_User','data_role_user','rid','uid');
    }


    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission','data_role_permission','rid','pid');
    }

}
