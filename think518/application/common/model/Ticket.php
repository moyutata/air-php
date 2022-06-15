<?php
namespace app\common\model;

use think\Model;

class Ticket extends Model{

    public function ticketadd($data){
        $this->create($data);
        return 1;
    }

}