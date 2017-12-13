<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:49
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use app\admin\model\ResourceType as ResourceTypeModel;
use think\Request;

class ResourceType extends BaseController
{

    /**
     *
     * @param ResourceTypeModel $resourceTypeModel
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 资源分类列表数据，包含分页
     */
    public function resourceTypeListApi(ResourceTypeModel $resourceTypeModel,$currentIndex,$pageSize){
        //获取资源分类列表
        return $resourceTypeModel->getResourceTypeListData($currentIndex,$pageSize);;
    }

    /**
     * 添加资源分类
     * @param ResourceTypeModel $resourceTypeModel
     * @return array|string|true
     * @internal param ResourceTypeModel $resourceTypeModel
     */
    public function addResourceTypeApi(ResourceTypeModel $resourceTypeModel)
    {
        $typeName = Request::instance()->param();
        //验证数据
        $checkTypeName = $this->validate($typeName, 'ResourceType');
        if (true !== $checkTypeName) {
            return $checkTypeName;
        }
        //添加资源分类
        return $resourceTypeModel->addResourceType($typeName);
    }

    /**
     * 编辑资源分类
     * @param resourceTypeModel $resourceTypeModel
     * @return bool
     */
    public function editResourceTypeApi(resourceTypeModel $resourceTypeModel)
    {
        $data = Request::instance()->param();
        //验证数据
        $checkTypeName = $this->validate($data, 'resourceType');
        if (true !== $checkTypeName) {
            return $checkTypeName;
        }
        //修改资源分类
        return $resourceTypeModel->editResourceType($data);
    }

    //删除资源分类
    public function resourceTypeDeleteApi(resourceTypeModel $resourceTypeModel){
        return $resourceTypeModel->deleteResourceType();
    }
}