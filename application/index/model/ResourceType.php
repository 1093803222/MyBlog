<?php
/**
 * Created by 信磊.
 * Date: 2017/8/8
 * Time: 19:05
 */

namespace app\index\model;


class ResourceType extends BaseModel
{
    public function getResourceType(){
        $type = $this->select();
        $html = '';
        foreach($type as $type){
           $html .= <<<HTML
        <span class="child-nav-btn" typeid="{$type['id']}">{$type['resource_type_name']}</span>
HTML;
        }
        return $html;
    }
}