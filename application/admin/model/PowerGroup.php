<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 19:05
 */

namespace app\admin\model;


class PowerGroup extends BaseModel
{
    //获取所有权限信息
    public static function getPowerGroupAll(){
        return self::select();
    }
}