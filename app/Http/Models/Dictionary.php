<?php
/**
 * Created by liao.
 * User: liao
 * Date: 2018-03-30
 * Time: 23:10
 */

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table='sys_dictionary';
    protected $primaryKey = ['TableName','ParentCode','Code'];
    public $timestamps = false;
}