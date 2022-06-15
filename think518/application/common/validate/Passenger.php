<?php
namespace app\common\validate;

use think\Validate;

class Passenger extends Validate{
    //规则
    protected $rule = [
        'passName|乘机人姓名' => 'require',
        'idNumber|身份证号' => 'require',
        'passSex|性别' => 'require',
        'passTel|联系方式' => 'require',
    ];
    //场景
    protected $scene = [
        'passengeradd' => ['passName','idNumber','passSex','passTel'],
    ];
}