<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 19:27
 */

namespace app\admin\validate;


class ResourceType extends BaseValidate
{
    protected $rule = [
        'resource_type_name' => 'require|unique:resourceType,resource_type_name|length:1,20',
    ];

    protected $message = [
        'resource_type_name.require' => '分类名称不得为空',
        'resource_type_name.unique' => '分类名称已存在',
        'resource_type_name.length' => '分类名称不得超过20个字符',
    ];
}