<?php
namespace app\common\validate;

use think\Validate;

class Executiveflight extends Validate{
    //规则
    protected $rule = [
        'depart|出发地' => 'require',
        'arrival|目的地' => 'require',
        'execDate|出发时间' => 'require|date',
    ];
    //场景
    protected $scene = [
        'search' => ['depart','arrival','execDate'],
    ];
}