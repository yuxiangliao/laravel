<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //表名
    protected $table='sys_users';
    //主键
    protected $primaryKey='Code';

    public $timestamps = false;
}
