<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 19:08
 */

namespace app\admin\model;


use think\Model;

class BaseModel extends Model
{
    public $code = 404;
    public $msg = '上传失败';
    public $data = '';

}