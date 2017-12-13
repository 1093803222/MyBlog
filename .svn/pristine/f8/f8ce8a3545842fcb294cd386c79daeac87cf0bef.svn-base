<?php
/**
 * Created by 信磊.
 * Date: 2017/8/6
 * Time: 15:55
 */

namespace app\index\model;


class ArticleType extends BaseModel
{
    //取得分类数据，并进行拼接html
    public function getArticleType(){
        $typeData = $this->select();
        $html = '';
        //拼接html
        foreach($typeData as $data){
            $html .= <<<TYPE
            <a href="javascript:;" typeId="{$data['id']}" typeName="{$data['article_type_name']}">{$data['article_type_name']}</a>
TYPE;
        }
        $html .= '<div class="clear"></div>';
        return $html;
    }
}