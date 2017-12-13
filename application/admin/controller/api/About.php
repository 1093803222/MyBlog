<?php
/**
 * Created by 信磊.
 * Date: 2017/8/12
 * Time: 22:42
 */

namespace app\admin\controller\api;


use app\admin\controller\show\BaseController;
use app\admin\model\About as AboutModel;

class About extends BaseController
{
    /**
     * 更新关于作者数据资料
     * @return mixed
     */
    public function editAboutAuthorApi (AboutModel $aboutModel)
    {
        return $aboutModel->updateAuthorAbout();
    }

    public function uploadImgApi (AboutModel $aboutModel)
    {
        return $aboutModel->uploadImg();
    }

    /**
     * 更新友情链接数据资料
     * @return bool|string
     */
    public function editAboutLinkApi (AboutModel $aboutModel)
    {
        return $aboutModel->updateLinkAbout();
    }

    public function addLinkApi (AboutModel $aboutModel)
    {
        return $aboutModel->addLink();
    }

    /**
     * 获取留言列表
     */
    public function getMessageDataApi (AboutModel $aboutModel, $currentIndex, $pageSize)
    {
        return $aboutModel->getMessageData($currentIndex, $pageSize);
    }
    //留言回复
    public function getMessageReplyApi(AboutModel $aboutModel){
        return $aboutModel->getMessageReply();
    }
    //删除留言回复
    public function deleteMessageApi(AboutModel $aboutModel){
        return $aboutModel->deleteMessage();
    }
    //删除留言回复
    public function deleteMessageReplyApi(AboutModel $aboutModel){
        return $aboutModel->deleteMessageReply();
    }
}