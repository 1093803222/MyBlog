<?php
/**
 * Created by 信磊.
 * Date: 2017/8/8
 * Time: 19:16
 */

namespace app\index\controller\api;

use app\index\model\Resource as ResourceModel;
use app\index\controller\show\BaseController;

class Resource extends BaseController
{
    /**
     * 根据资源类型id获得资源数据
     * @type_id int 资源类型id
     */
    public function getResourceApi(ResourceModel $resourceModel, $type_id = '%')
    {
        return $resourceModel->getResource($type_id);
    }
}