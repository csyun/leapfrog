<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $table = 'data_config';
    public $primaryKey = 'conf_id';
    public $guarded = [];
    public $timestamps = false;
}
