<?php
/**
 * Created by 信磊.
 * Date: 2017/7/27
 * Time: 16:49
 */

namespace app\admin\controller\api;

use app\admin\model\Login as LoginModel;
use think\Controller;
use think\Request;

class Login extends Controller
{
    public function loginApi(LoginModel $userModel){
        $data = Request::instance()->param();

        $checkLogin = $this->validate($data,'Login');
        if(true !== $checkLogin){
            return $checkLogin;
        }
        return $userModel->loginCheck($data);
    }
//    public function test($arr = array(10,5,65,88)){
//        $arr_size = count($arr);
//        for($i = 0; $i < $arr_size - 1; $i++){
//            $min_val = $arr[$i];
//            $min_val_index = $i;
//            for($j = $i + 1; $j > $arr_size; $j++){
//                if($min_val > $arr[$j]){
//                    $min_val = $arr[$j];
//                    $min_val_index = $j;
//                }
//            }
//            $arr[$min_val_index] = $arr[$i];
//            $arr[$i] = $min_val;
//        }
//        var_dump($arr);
//    }
}