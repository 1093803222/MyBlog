<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 21:41
 */

namespace app\admin\controller\show;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public function __construct(){
        if(!Session::has('account')){
//            echo "layer.msg('请先登陆后操作',{icon:6});";
//            sleep(3);
            return $this->redirect('/admin-login');
//            return $this->error('未登录',url('admin/login/index'));
        }
    }
}