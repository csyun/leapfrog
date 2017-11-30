<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_config extends Model
{
    //
    protected $table = 'data_config';
    public $primaryKey = 'cid';
    public $guarded = [];
    public $timestamps = false;


}
