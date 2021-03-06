<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 与后台用户表data_admin_user关联的模型
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 19:30
 * 
 */

class Admin_User extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_admin_user';
	//定义主键  , 默认值就是id
    public $primaryKey = 'uid';

	// 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 设置允许批量修改的字段
    // public $fillable = ['username','userpass','telephone'];

    // 不允许批量修改的字段
   	public $guarded = [];

    /**
     * 通过用户模型查找关联的角色模型
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('App\Models\Role','data_role_user','uid','rid');
    }

}
