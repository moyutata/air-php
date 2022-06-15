<?php
namespace app\common\model;

use think\Model;

class User extends Model {

    public function login($data){
        //验证
        $validate = new \app\common\validate\User();
        if($validate->scene('login')->check($data)==0){
            return $validate->getError();
        }
        //查询
        $data['password']=md5($data['password']);
        $res=$this->where($data)->find();
        if($res){
            session('userId',$res['userId']);
            session('userTel',$res['tel']);
            return 1;
        }else{
            return "账号或密码错误！";
        }
    }

    public function register($data){
        //验证
        $validate = new \app\common\validate\User();
        if($validate->scene('register')->check($data)==0){
            return $validate->getError();
        }

        //查询
        $res=$this->where('loginId',$data['loginId'])->find();
        if($res){
            return "注册失败，账号已存在！";
        }
        $this->create([
            'loginId' => $data['loginId'],
            'password' => md5($data['password']),
            'tel' => $data['tel'],
            'email' => $data['email'],
            'userName' => $data['userName'],
            'sex' => $data['sex'],
            'age' => $data['age'],
        ]);
        return 1;
    }
}