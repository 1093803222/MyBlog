<?php
/**
 * Created by 信磊.
 * Date: 2017/8/7
 * Time: 17:05
 */

namespace app\index\controller\api;


use app\index\controller\show\BaseController;
use app\index\model\ArticleComment;
class Article extends BaseController
{
    public function articleCommentApi(ArticleComment $articleComment, $id = 0, $content){
        return $articleComment->comment($id, $content);
    }
    //获取更多评论
    public function getArticleCommentPageApi(ArticleComment $articleComment, $pageSize){
        return $articleComment->getArticleCommentData($pageSize);
    }

}