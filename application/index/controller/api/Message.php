<?php
/**
 * Created by 信磊.
 * Date: 2017/8/20
 * Time: 16:38
 */

namespace app\index\controller\api;

use app\index\model\Message as MessageModel;
use app\index\controller\show\BaseController;

class Message extends BaseController
{
    /*
     * **************************************
     * @model Message模型依赖注入1
     * @id int 上级留言id，默认0为顶级留言
     * @content 留言内容
     * @return bool|\think\response\Json
     * **************************************
     */
    public function remarkApi(MessageModel $messageModel, $id = 0, $content)
    {
        return $messageModel->remark($id, $content);
    }

    public function getRemarkPageApi(MessageModel $messageModel, $pageSize){
        return $messageModel->getRemarkData($pageSize);
    }

}