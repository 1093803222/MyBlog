<?php
/**
 * Created by 信磊.
 * Date: 2017/7/27
 * Time: 20:19
 */

namespace app\admin\model;


use think\Session;

class Login extends BaseModel
{
    /**
     * @param $data
     * @return boolean
     */
    public function loginCheck($data){
        $user = new User;
        $findResult = $user->get(['account'=>$data['account']]);
        //如果账号不存在
        if(!$findResult) return '账号或密码错误';
        //如果密码错误
        if($findResult->getAttr('password') != md5($data['password']))
            return '账号或密码错误';
        //记录session
        Session::set('id',$findResult->getAttr('id'));
        Session::set('account',$findResult->getAttr('account'));
        Session::set('name',$findResult->getAttr('name'));
        return true;
    }
}