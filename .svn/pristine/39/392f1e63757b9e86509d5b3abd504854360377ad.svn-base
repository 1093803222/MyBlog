<?php
/**
 * Created by 信磊.
 * Date: 2017/7/23
 * Time: 16:42
 */

namespace app\admin\controller\show;

use app\admin\model\ArticleType as ArticleTypeModel;

class ArticleType extends BaseController
{
    public function index()
    {
        return view('articleTypeList');
    }

    //添加文章分类
    public function addArticleType()
    {
        return view('addArticleType');
    }


    // 编辑文章分类
    public function editArticleType(ArticleTypeModel $articleTypeModel, $id)
    {
        $articleType = $articleTypeModel->getArticleTypeOne($id);
        return view('editArticleType', array('id' => $id, 'articleType' => $articleType));
    }
}