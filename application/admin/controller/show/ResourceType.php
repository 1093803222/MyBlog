<?php
/**
 * Created by 信磊.
 * Date: 2017/8/1
 * Time: 17:46
 */

namespace app\admin\controller\show;

use app\admin\model\ResourceType as ResourceTypeModel;
class ResourceType extends BaseController
{
    //资源分类列表
    public function index(){
        return view('resourceTypeList');
    }

    //资源分类添加页
    public function addResourceType(){
        return view('addResourceType');
    }
    // 编辑资源分类
    public function editResourceType(ResourceTypeModel $resourceTypeModel, $id)
    {
        $resourceType = $resourceTypeModel->getResourceTypeOne($id);
        return view('editResourceType', array('id' => $id, 'resourceType' => $resourceType));
    }
}