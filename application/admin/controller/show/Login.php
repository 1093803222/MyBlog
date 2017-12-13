<?php
/**
 * Created by 信磊.
 * Date: 2017/7/23
 * Time: 16:54
 */

namespace app\admin\controller\show;


class Login
{
    public function index(){
        return view('index');
    }
    public function loginOut(){
        session(null);
    }

}