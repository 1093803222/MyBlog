<?php
/**
 * Created by 信磊.
 * Date: 2017/7/29
 * Time: 21:33
 */

namespace app\admin\validate;


class Article extends BaseValidate
{
    //验证规则
    protected $rule = [
        'title'     =>  'require|length:1,100|unique:Article,title',
        'description'     =>  'require|length:1,255',
        'type_id'     =>  'require|number',
        'content'     =>  'require',
        'cover_src'     =>  'require',
    ];

    //错误信息
    protected $message = [
        'title.require'     =>  '标题不得为空',
        'title.length'     =>  '标题的长度不得超过100个字符',
        'title.unique'     =>  '标题已存在',
        'description.require'=> '摘要不得为空',
        'description.length'=> '摘要的长度不得超过100个字符',
        'type_id.require'   =>  '请选择分类',
        'type_id.number'    =>  '请选择分类',
        'content.require'   =>  '文章内容不得为空',
        'cover_src.require'=> '请上传文章封面',
    ];

    //验证场景
    protected $scene = [
        'edit'  =>  ['title','description','type_id','content']
    ];

}