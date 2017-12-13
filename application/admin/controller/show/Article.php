<?php
/**
 * Created by 信磊.
 * Date: 2017/7/23
 * Time: 16:42
 */

namespace app\admin\controller\show;

use app\admin\model\ArticleType;
use app\admin\model\Article as ArticleModel;
use think\View;
class Article extends BaseController
{
    public function index(ArticleType $articleType){
        $type = $articleType->getArticleTypeAll();
        return view('articleList', ['type' => $type]);
    }

    /**
     * 发表文章
     * @param \app\admin\controller\show\ArticleType|ArticleType $articleType
     * @return \think\response\View
     */
    public function addArticle(ArticleType $articleType){
        //获得所有文章分类数据
        $articleTypeAll = $articleType->getArticleTypeAll();
        return view('addArticle',array('articleTypeAll' => $articleTypeAll));
    }

    /**
     * 编辑文章
     * @param ArticleType $articleType
     * @param ArticleModel $articleModel
     * @param $id
     * @return \think\response\View
     */
    public function editArticle(ArticleType $articleType,ArticleModel $articleModel,$id){
        //获得所有文章分类数据
        $articleTypeAll = $articleType->getArticleTypeAll();
        //获得待编辑文章数据
        $article = $articleModel->hidden('edit_time','click','delete')->get($id);

        return view('editArticle',array('articleTypeAll' => $articleTypeAll,'article'=>$article,'id'=>$id));
    }

    //文章回收站
    public function articleRecycle(){
        return view('articleRecycle');
    }

    //文章评论页面
    public function articleCommentList ()
    {
        return view('articleCommentList');
    }
    //文章评论回复页面
    public function articleCommentReply ($id)
    {
        View::share('id', $id);
        return view('articleCommentReply');
    }
}