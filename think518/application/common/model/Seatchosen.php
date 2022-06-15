<?php
namespace app\common\model;

use think\Model;

class Seatchosen extends Model{

    public function seatadd($data){

        $res = $this->where($data)->find();
        if($res){
           return "该座位已被选！";
        }
        $this->create($data);
        return 1;
    }
}