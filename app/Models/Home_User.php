<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 与前台用户表data_home_user关联的模型
 * @author [苏波] <386249656@qq.com>
 * @data 2017-11-28 20:00
 * @关联了模型UserInfo
 */

class Home_User extends Model
{
    //模型关联的表 ，如果命名符合规范可以不定义
    public $table = 'data_home_user';
	//定义主键  , 默认值就是id
    public $primaryKey = 'uid';

	// 定义时间戳  larval会自动维护create_at update_at两个表字段，所以如果表中没有这两个字段，一定要关闭自维护
    public $timestamps = false;

    // 设置允许批量修改的字段
    public $fillable = [];

    // 不允许批量修改的字段
   	// public $guarded = [];
   	

   	public function userinfo(){
		//参数1 ：要关联的模型
		//参数2：外键
		//参数3：当前模型的主键
		//return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Models\UserInfo','uid','uid');
    }


}
