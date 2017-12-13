<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:49
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use app\admin\model\ArticleType as ArticleTypeModel;
use think\Request;

class ArticleType extends BaseController
{

    /**
     * @param ArticleTypeModel $articleTypeModel
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 文章分类列表数据，包含分页
     */
    public function articleTypeListApi(ArticleTypeModel $articleTypeModel,$currentIndex,$pageSize){
        //获取文章分类列表
        return $articleTypeModel->getArticleTypeListData($currentIndex,$pageSize);;
    }

    /**
     * 添加文章分类
     * @param ArticleTypeModel $articleTypeModel
     * @return bool
     */
    public function addArticleTypeApi(ArticleTypeModel $articleTypeModel)
    {
        $typeName = Request::instance()->param();
        //验证数据
        $checkTypeName = $this->validate($typeName, 'ArticleType');
        if (true !== $checkTypeName) {
            return $checkTypeName;
        }
        //添加文章分类
        return $articleTypeModel->addArticleType($typeName);
    }

    /**
     * 编辑文章分类
     * @param ArticleTypeModel $articleTypeModel
     * @return bool
     */
    public function editArticleTypeApi(ArticleTypeModel $articleTypeModel)
    {
        $data = Request::instance()->param();
        //验证数据
        $checkTypeName = $this->validate($data, 'ArticleType');
        if (true !== $checkTypeName) {
            return $checkTypeName;
        }
        //修改文章分类
        return $articleTypeModel->editArticleType($data);
    }

    //删除文章分类
    public function articleTypeDeleteApi(ArticleTypeModel $articleTypeModel){
        return $articleTypeModel->deleteArticleType();
    }
}