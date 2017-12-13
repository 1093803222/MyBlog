<?php
/**
 * Created by 信磊.
 * Date: 2017/8/4
 * Time: 16:14
 */

namespace app\index\controller\show;


use app\index\model\ResourceType;
use think\View;

class Resource extends BaseController
{
    public function index(ResourceType $resourceType){
        //资源分类
        $type = $resourceType->getResourceType();
        View::share('type',$type);
        return view();
    }
}