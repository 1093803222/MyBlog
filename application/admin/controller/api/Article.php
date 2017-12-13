<?php
/**
 * Created by 信磊.
 * Date: 2017/7/29
 * Time: 17:48
 */

namespace app\admin\controller\api;

use app\admin\model\Article as ArticleModel;
use app\admin\controller\show\BaseController;
use think\Request;

class Article extends BaseController
{

    /**
     * 文章列表数据接口
     * @param ArticleModel $articleModel
     * @param $currentIndex 当前页
     * @param $pageSize 每页显示数量
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function articleListApi(ArticleModel $articleModel, $currentIndex, $pageSize, $type_id = '%', $keywords = '%'){
        return $articleModel->getArticleListData($currentIndex,$pageSize, $type_id, $keywords);
    }

    //文章Checked监听
    public function setArticleChecked(ArticleModel $articleModel){
        $data = Request::instance()->param();
        return $articleModel->setArticleChecked($data);
    }

    /**
     * 文章封面上传接口
     * @param ArticleModel $articleModel
     * @return \think\response\Json 封面上传Json
     */
    public function uploadArticleCoverApi(ArticleModel $articleModel){
        //进行文章封面上传操作
        return $articleModel->uploadArticleICover();
    }

    /**
     * 文章添加接口
     * @param ArticleModel $articleModel
     * @return \think\response\Json
     */
    public function addArticleApi(ArticleModel $articleModel){
        $data = Request::instance()->param();
        //检测表单数据
        $checkArticle = $this->validate($data,'Article');
        if(true !== $checkArticle){
            return $checkArticle;
        }
        $info = $articleModel->addArticle($data);
        return $info;
    }

    /**
     * 修改文章封面上传接口
     * @param ArticleModel $articleModel
     * @return \think\response\Json 封面上传Json
     */
    public function editArticleCoverApi(ArticleModel $articleModel){
        //修改文章封面上传操作
        return $articleModel->editArticleICover();
    }


    /**
     * 文章修改接口
     * @param ArticleModel $articleModel
     * @return \think\response\Json
     */
    public function editArticleApi(ArticleModel $articleModel){
        $data = Request::instance()->param();
        //检测表单数据
        $checkArticle = $this->validate($data,'Article.edit');
        if(true !== $checkArticle){
            return $checkArticle;
        }
        $info = $articleModel->editArticle($data);
        return $info;
    }

    /**
     * 取消文章发布调用函数
     */
    public function closeIframeArticle(){
        $cover = Request::instance()->param();
        unlink('.' . $cover['cover']);
    }

    /**
     * 文章删除到回收站
     * @param ArticleModel $articleModel
     * @return boolean
     */
    public function deleteArticleApi(ArticleModel $articleModel){
        return $articleModel->deleteArticle();
    }

    /**
     * 文章回收站
     * @param ArticleModel $articleModel
     * @param $currentIndex 当前页
     * @param $pageSize 每页显示数量
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function articleRecycleListApi(ArticleModel $articleModel, $currentIndex, $pageSize){
        return $articleModel->getArticleRecycleListData($currentIndex,$pageSize);
    }


    /**
     * 文章回收站删除
     * @param ArticleModel $articleModel
     * @return boolean
     */
    public function deleteArticleRecycleApi(ArticleModel $articleModel){
        return $articleModel->deleteArticleRecycle();
    }


    /**
     * 文章回收站恢复
     * @param ArticleModel $articleModel
     * @return boolean
     */
    public function recoveryArticleRecycleApi(ArticleModel $articleModel){
        return $articleModel->recoveryArticleRecycle();
    }


    /**
     * 获取文章评论列表
     */
    public function getCommentDataApi (ArticleModel $articleModel, $currentIndex, $pageSize)
    {
        return $articleModel->getCommentData($currentIndex, $pageSize);
    }
    //文章评论回复
    public function getCommentReplyApi(ArticleModel $articleModel){
        return $articleModel->getCommentReply();
    }
    //删除文章评论
    public function deleteCommentApi(ArticleModel $articleModel){
        return $articleModel->deleteComment();
    }
    //删除文章评论回复
    public function deleteCommentReplyApi(AboutModel $aboutModel){
        return $aboutModel->deleteCommentReply();
    }
}