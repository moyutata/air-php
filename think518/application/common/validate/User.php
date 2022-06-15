<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate{
    //规则
    protected $rule = [
        'loginId|账号' => 'require',
        'password|密码' => 'require',
        'confirm|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email',
        'age|年龄' => 'require|number',
        'tel|电话号码' => 'require',
        'sex|性别' => 'require',
        'userName|昵称' => 'require',
        'captcha|验证码' => 'require|captcha',
    ];
    //场景
    protected $scene = [
        'login' => ['loginId','password'],
        'register' => ['loginId','password','confirm','userName','sex','age','tel','email','captcha'],
    ];
}