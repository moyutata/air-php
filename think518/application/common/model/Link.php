<?php
namespace app\common\model;

use think\Model;

class Link extends Model{

    public function linkadd($data){

        $this->create($data);
        return 1;
    }
}