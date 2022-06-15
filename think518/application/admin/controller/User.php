<?php
namespace app\admin\controller;

use think\Controller;

class User extends Controller{
    //login
    public function login(){

        if(session('?loginId')){
            $this->redirect('admin/flight/main');
            return ;
        }

        if(request()->isAjax()){
            $data = [
                'loginId' => input('loginId'),
                'password' => input('password'),
            ];
            $res=model('User')->login($data);
            if($res==1){
                session('loginId',$data['loginId']);
                $this->success('登录成功','admin/flight/main');
            }else{
                $this->error($res);
            }
        }
        return view();
    }

    //register
    public function register(){
        if(request()->isAjax()){
            $data = [
                'loginId' => input('loginId'),
                'password' => input('password'),
                'confirm' => input('confirm'),
                'userName' => input('userName'),
                'sex' => input('sex'),
                'age' => input('age'),
                'tel' => input('tel'),
                'email' => input('email'),
                'captcha' => input('captcha'),
            ];
            $res=model('User')->register($data);
            if($res==1){
                $this->success('注册成功！','admin/user/login');
            }else{
                $this->error($res);
            }
        }
        return view();
    }

    //logout
    public function logout(){
        session(null);
        $this->success('退出成功！','admin/user/login');
    }
}
