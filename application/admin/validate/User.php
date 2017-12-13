<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 21:23
 */

namespace app\admin\validate;


class User extends BaseValidate
{
    //验证规则
    protected $rule = [
        'account'  =>  'require|length:5,16|alphaNum|unique:user,account',
        'password'  =>  'require|length:5,16|alphaNum',
        'isPassword'=>  'require|checkIsPassword',
        'name'      =>  'require|length:1,10',
        'email'      =>  'require|email',
        'power_group_id' => 'require|number',
    ];

    protected $message = [
        'account.require'  =>  '用户名不得为空',
        'account.length'  =>  '用户名必须5~16个字符',
        'account.regex'  =>  '用户名必须为数字或字母',
        'account.unique'  => '用户名已存在',
        'password.require'  =>  '密码不得为空',
        'password.length'  =>  '密码必须5~16个字符',
        'password.regex'  =>  '密码必须为数字或字母',
        'isPassword.require'  =>  '确认密码不得为空',
        'name.require'  =>  '昵称不得为空',
        'name.length'  =>  '昵称必须1~10个字符',
        'email.require'  =>  '邮箱不得为空',
        'email.email'  =>  '邮箱格式不正确',
        'power_group_id.require'  =>  '请选择权限组',
        'power_group_id.number'  =>  '请选择权限组',
    ];

    protected $scene = [
            'edit'  =>  ['account','password'=>'length:5,16|alphaNum|checkIsPassword','name','email'],
        ];

    //验证确认密码
    protected function checkIsPassword($password,$rule,$data){
        if(!empty($data['password'])){
            if(empty($data['isPassword'])) return "请输入确认密码";
            return $password == $data['isPassword'] ? true : '确认密码不一致';
        }
    }
}