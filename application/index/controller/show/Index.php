<?php
/**
 * Created by 信磊.
 * Date: 2017/8/4
 * Time: 15:53
 */

namespace app\index\controller\show;

use app\index\model\Index as IndexModel;
use think\Exception;

class Index extends BaseController
{
    public function index(IndexModel $indexModel)
    {
        $sideData = $indexModel->sideData();
        //获取天气数据
        $weatherObj = $indexModel->weather();
        //统计在线人数
        $count = 1;
//        $this->getOnlineCount();
//        die;
        try{
            return view('index', ['sideData' => $sideData, 'weather' => $weatherObj->result, 'count' => $count]);
        }catch(Exception $e){}

    }

    public function getOnlineCount(){
//        $count = count(cookie('uid'));
//        file_put_contents('online/online.txt', 44 . "\n", FILE_APPEND);
        $file ='online/online.txt';
        $fileStr = file($file);
        $fp = fopen($file);
        foreach($fileStr as $line){
            if($line <> 22) fputs($fp, $line);
        }
    }

}