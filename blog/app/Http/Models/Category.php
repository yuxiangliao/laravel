<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //表名
    protected $table='category';
    //主键
    protected $primaryKey='cate_id';

    public $timestamps = false;

    protected $guarded=[];

    public function tree()
    {
        $categorys = $this->all();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }

//    public static function tree()
//    {
//        $categorys = Category::all();
//        return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid');
//    }

    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }

    private static $_instance;
    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new Category();
        return self::$_instance;
    }
}
