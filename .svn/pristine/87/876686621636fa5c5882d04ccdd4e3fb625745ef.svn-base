<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 19:03
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use app\admin\model\PowerGroup;

class Power extends BaseController
{
    public function getPower(){
        $powerAll = PowerGroup::getPowerGroupAll();
        return json($powerAll);
    }
}