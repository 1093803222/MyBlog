<?php
/**
 * Created by 信磊.
 * Date: 2017/7/23
 * Time: 18:20
 */

namespace app\admin\controller\show;

use app\admin\model\User as UserModel;
use app\admin\model\PowerGroup;

class User extends BaseController
{
    //用户列表
    public function index(){
        return view();
    }

    //添加用户
    public function addUserPage(){
        return view('addUser');
    }
    //编辑用户
    public function editUserPage($id,UserModel $userModel){
        $powerGroup = PowerGroup::getPowerGroupAll();
        $userData = $userModel->getUserOne($id);
        return view('editUser',array('id'=>$id,'powerGroup'=>$powerGroup,'userData'=>$userData));
    }


}