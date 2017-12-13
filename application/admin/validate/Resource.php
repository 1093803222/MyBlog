<?php
/**
 * Created by 信磊.
 * Date: 2017/8/2
 * Time: 18:07
 */

namespace app\admin\validate;


class Resource extends BaseValidate
{
    protected $rule = [
        'title' => 'require|length:1,10|unique:Resource,title',
        'desc' => 'require|length:1,70',
        'type_id' => 'require|number',
        'link' => 'require|url',
        'cover_src' => 'require'
    ];

    protected $message = [
        'title.require' => '资源名称不得为空',
        'title.length' => '资源名称长度不得超过10个字符',
        'title.unique' => '资源名称已存在',
        'desc.require' => '摘要不得为空',
        'desc.length' => '摘要不得超过70个字符',
        'type_id.require' => '请选择所属资源分类',
        'type_id.number' => '请选择所属资源分类',
        'link.require' => '链接地址不得为空',
        'link.url' => '链接地址格式不正确',
        'cover_src' => '请上传封面'
    ];

    protected $scene = [
        'edit' => ['title','desc','type_id','link']
    ];
}