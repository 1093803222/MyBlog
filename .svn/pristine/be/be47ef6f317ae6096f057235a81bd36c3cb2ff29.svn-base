<?php
/**
 * Created by 信磊.
 * Date: 2017/7/27
 * Time: 18:20
 */

namespace app\admin\validate;


class Login extends BaseValidate
{
    protected $rule = [
        'account'   =>  'require',
        'password'  =>  'require',
        'verify'    =>  'require|captcha'
    ];

    protected $message = [
        'account.require'   =>  '账号不得为空',
        'password.require'  =>  '密码不得为空',
        'verify.account'    =>  '请填写验证码',
        'verify.captcha'    =>  '验证码错误'
    ];
}