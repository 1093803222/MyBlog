<?php
/**
 * Created by 信磊.
 * Date: 2017/8/1
 * Time: 17:45
 */

namespace app\admin\controller\show;

use app\admin\model\ResourceType;
use app\admin\model\Resource as ResourceModel;

class Resource extends BaseController
{
    //资源列表页
    public function index(ResourceType $resourceType)
    {
        $resourceType = $resourceType->select();
        return view('resourceList', ['type' => $resourceType]);
    }

    //资源添加页
    public function addResource(ResourceType $resourceType)
    {
        $resourceType = $resourceType->select();
        return view('addResource', array('resourceType' => $resourceType));
    }

    //资源添加页
    public function editResource(ResourceModel $resourceModel, ResourceType $resourceType, $id)
    {
        $resource = $resourceModel->where('id', '=', $id)->find();
        $resourceType = $resourceType->select();
        return view('editResource', array('resourceType' => $resourceType,'resource'=>$resource,'id'=>$id));
    }

    //资源列表页
    public function resourceRecycle()
    {
        return view('resourceRecycle');
    }
}