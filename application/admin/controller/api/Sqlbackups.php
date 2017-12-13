<?php
/**
 * Created by 信磊.
 * Date: 2017/9/9
 * Time: 10:34
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use \org\Baksql;
class Sqlbackups extends BaseController
{
    public function sqlbackupsApi ()
    {
        //数据库备份
        $type = input("tp");
        $name = input("name");
        $sql = new Baksql(\think\Config::get("database"));
        switch ( $type ) {
            case "backup": //备份
                return $sql->backup();
                break;
            case "dowonload": //下载
                $sql->downloadFile($name);
                break;
            case "restore": //还原
                return $sql->restore($name);
                break;
            case "del": //删除
                return $sql->delfilename($name);
                break;
            default: //获取备份文件列表,1:倒序
                return $sql->get_filelist('1');
        }
    }
}