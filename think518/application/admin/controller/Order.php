<?php
namespace app\admin\controller;

use think\Controller;

class Order extends Controller{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        if(!session('loginId')){
            $this->redirect('admin/user/login');
        }
    }

    public function orderadd(){
        $passenger = session('passenger');
        $this->assign('passenger',$passenger);
        $this->assign('order',session('order'));
        return $this->fetch();
    }

    //订单详情
    public function orderone(){

        if(request()->isAjax()){
            $data = [
                'loginId' => session('loginId'),
                'userId' => session('userId'),
                'totalPrice' => '1330.00',
                'paymentStatus' =>input('paymentStatus'),
                'tel' => input('tel'),
            ];
            $res = model('Orders')->orderadd($data);
            $data2 = [
                'loginId' => session('loginId'),
                'userId' => session('userId'),
            ];
            $temp = model('Orders')->orderquery($data2);
            session('orderId',$temp['orderId']);
            if($res==1){
                $this->assign('totalPrice',$data['totalPrice']);
                $this->success("购买成功！",'admin/order/orderone');
            }else{
                $this->error($res);
            }
        }
        return view();
    }

    //所有订单
    public function orderlist(){

        $loginId = session('loginId');
        $res = model("Orders")->query("
            select orders.orderId,orders.loginId,user.userName,orders.totalPrice,orders.paymentStatus,orders.tel
            from orders,user where orders.userId = user.userId and orders.loginId=?;",[$loginId]);

        $this->assign("list",$res);
        return view();
    }

    //删除
    public function orderdelete(){

        //orderId
        $data = [
            'orderId' => input('orderId'),
        ];
        model('Orders')->where('orderId',$data['orderId'])->delete();
        session("orderIdDel",$data['orderId']);
        $this->success("退款成功",'admin/ticket/ticketdelete');
    }
}