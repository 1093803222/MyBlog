<?php
/**
 * Created by 信磊.
 * Date: 2017/7/23
 * Time: 20:38
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use think\Request;
use app\admin\model\User as UserModel;

class User extends BaseController
{
    /**
     * 获取用户列表
     * @param UserModel $userModel
     * @param $currentIndex 当前页
     * @param $pageSize 每页数
     * @return \think\response\Json
     */
    public function userListApi(UserMOdel $userModel, $currentIndex, $pageSize){
        $data = $userModel->getUserList($currentIndex,$pageSize);
       return $data;
    }

    //设置黑名单
    public function setBlackListApi(UserModel $userModel){
        $data = Request::instance()->param();
        $userModel->setBlackList($data);
    }

    //添加用户数据
    public function addUserApi(){
        //接收数据
        $data = Request::instance()->param();
        //验证数据
        $checkResult = $this->validate($data,'User');
        if(true !== $checkResult){
            return $checkResult;
        }
        //添加数据
        $addUser = UserModel::setAddUser($data);
        if( !is_object($addUser) ){
            return '添加失败';
        }
        return true;
    }

    //编辑用户数据
    public function editUserApi(){
        //接收数据
        $data = Request::instance()->param();
        //验证数据
        $checkResult = $this->validate($data,'User.edit');
        if(true !== $checkResult){
            return $checkResult;
        }
//        var_dump($data);
//        更新数据
        $editUser = UserModel::setEditUser($data);

        if( $editUser>1 ){
            return '修改失败';
        }
        return true;
    }

    //删除用户
    public function deleteUserApi(UserModel $userModel){
        $id = Request::instance()->post('id');
        if($id == 1){
            return '不能删除admin账号';
        }
        if($userModel->where('id','=',$id)->delete()){
            return true;
        }else{
            return '删除失败';
        }
    }

}