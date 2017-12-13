<?php
/**
 * Created by 信磊.
 * Date: 2017/8/17
 * Time: 16:01
 */

namespace app\admin\validate;


class Link extends BaseValidate
{
    protected $rule = [
        'link_name' => 'unique:link|length:1,10',
        'link_url' => 'url|unique:link',
    ];

    protected $message = [
        'link_name.unique' => '链接名称已存在',
        'link_name.length' => '链接名称不得超过10个字符',
        'link_url.url' => '链接地址格式不正确',
        'link_url.unique' => '链接地址已存在'
    ];
}