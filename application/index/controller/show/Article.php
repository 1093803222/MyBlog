<?php
/**
 * Created by 信磊.
 * Date: 2017/8/4
 * Time: 16:11
 */

namespace app\index\controller\show;

use app\index\model\ArticleType as ArticleTypeModel;
use app\index\model\Article as ArticleModel;
use app\index\model\ArticleComment;
use think\Db;
use think\View;

class Article extends BaseController
{
    public function index(ArticleTypeModel $articleTypeModel)
    {
        $typeData = $articleTypeModel->getArticleType();
        $recommend = Db::table('blog_article')
            ->where('recommend', '=', 1)
            ->where("`delete` is null OR `delete` = ''")
            ->field('id,title')
            ->limit(10)
            ->order('edit_time desc')
            ->select();
        //赋值模板变量
        View::share(['typeData' => $typeData, 'recommend' => $recommend]);
        return view();
    }

    //文章详细页
    public function detail(ArticleTypeModel $articleTypeModel, ArticleModel $articleModel, ArticleComment $articleComment)
    {
        $typeData = $articleTypeModel->getArticleType();
        $detailData = $articleModel->getArticle();
        $randArticle = Db::table('blog_article')
            ->where("`delete` is null OR `delete` = ''")
            ->field('id,title')
            ->limit(10)
            ->order('rand()')
            ->select();
        //查找评论内容
        $comment =$articleComment->getArticleCommentData();
        //赋值模板变量
        View::share([
            'typeData' => $typeData,
            'detailData' => $detailData,
            'randArticle' => $randArticle,
            'comment' => $comment,
        ]);
        return view('detail',['id'=>input('id')]);
    }
}