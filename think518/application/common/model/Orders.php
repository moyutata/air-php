<?php
namespace app\common\model;

use think\Model;

class Orders extends Model{

    public function orderadd($data){
        $this->create($data);
        return 1;
    }

    public function orderquery($data){
        $res = $this->where($data)->find();
        return $res;
    }
}