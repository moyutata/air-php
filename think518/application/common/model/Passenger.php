<?php
namespace app\common\model;

use think\Model;

class Passenger extends Model{

    public function passengeradd($data){
        $validate = new \app\common\validate\Passenger();
        if($validate->scene('passengeradd')->check($data)==0){
            return $validate->getError();
        }

        //查询
        $id = $data['idNumber'];
        $res=$this->table('passenger')
            ->alias('a')
            ->join('link b',"a.idNumber=b.idNumber AND a.idNumber='$id'")
            ->find();
        if($res){
            return "添加失败，该乘客信息已存在";
        }
        $this->create($data);
        return 1;
    }

}