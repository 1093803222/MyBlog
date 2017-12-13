<?php
/**
 * Created by 信磊.
 * Date: 2017/8/6
 * Time: 14:46
 */

namespace app\index\controller\api;


use app\index\controller\show\BaseController;
use app\index\model\Index as IndexModel;
class Index extends BaseController
{
    //首页获取文章列表
    public function getArticleListApi(IndexModel $indexModel,$pageSize = 10, $pageIndex = 1,$type_id='%',$keywords="%"){
        return $indexModel->getArticleList($pageSize,$pageIndex,$type_id,$keywords);
    }
}