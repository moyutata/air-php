<?php
namespace app\admin\controller;

use think\Controller;

class Passenger extends Controller{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        if(!session('loginId')){
            $this->redirect('admin/user/login');
        }
    }

    //list
    public function passengerlist(){
        $id = session('loginId');
        $list = model('Passenger')
            ->query("select * from passenger,link where passenger.idNumber=link.idNumber and link.loginId=?",[$id]);
        $this->assign('list',$list);

        return $this->fetch();
    }

    //add
    public function passengeradd(){
        if(request()->isAjax()){
            $data = [
                'passName' => input('passName'),
                'idNumber' => input('idNumber'),
                'passTel' => input('passTel'),
                'passSex' => input('passSex'),
            ];
            $res=model('Passenger')->passengeradd($data);
            if($res==1){
                session('idNumber',$data['idNumber']);
                session('passenger',$data);
                $this->success("添加乘机人成功！",'admin/link/linkadd');
            }else{
                $this->error($res);
            }
        }
        return view();
    }


    //delete
    public function passengerdelete(){
        //idNumber
        $data = [
            'idNumber' => input('idNumber'),
        ];
        model('Passenger')->where('idNumber',$data['idNumber'])->delete();
        session("idNumberDel",$data['idNumber']);
        $this->success("删除乘机人成功",'admin/link/linkdelete');
    }

}
