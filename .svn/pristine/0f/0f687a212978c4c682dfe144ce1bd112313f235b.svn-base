<?php
/**
 * Created by 信磊.
 * Date: 2017/7/29
 * Time: 21:15
 */

namespace app\admin\model;

use think\Cache;
use think\Image;
use think\Request;
use think\Session;
use think\Db;

class Article extends BaseModel
{
    //得到数据库最大的id，进行拼接缓存名称
    private $articleId = null;

    //关联用户
    public function getUser ()
    {
        return $this->hasOne('User', 'id', 'user_id')->field('id,name');
    }

    //关联文章分类
    public function getArticleType ()
    {
        return $this->hasOne('ArticleType', 'id', 'type_id')->field('id,article_type_name');
    }

    /**
     * 文章列表数据
     * @param $currentIndex 当前页
     * @param $pageSize 每页显示数量
     * @return false|\PDOStatement|string|\think\Collection 分页好的数据
     */
    public function getArticleListData ($currentIndex, $pageSize, $type_id, $keywords)
    {
        //总记录数
        $count = $this->where("`type_id` LIKE ? AND ((`title` LIKE ? OR `description` LIKE ?) AND (`delete` is null OR `delete` = ''))", [$type_id, '%'.$keywords.'%', '%'.$keywords.'%'])->count();
        //总页数 = ceil(总记录数 / 每页显示数量)
        $pages = ceil($count / $pageSize);
        //分页  limit( 每页数量 * ( 当前页 - 1 ) , 每页显示数)
        $data = $this->with('getUser,getArticleType')
//            ->where('delete', null)
//            ->whereOr('delete', '')
            ->where("`type_id` LIKE ? AND ((`title` LIKE ? OR `description` LIKE ?) AND (`delete` is null OR `delete` = ''))", [$type_id, '%'.$keywords.'%', '%'.$keywords.'%'])
            ->limit($pageSize * ($currentIndex - 1), $pageSize)
            ->field([ 'id', 'title', 'top', 'recommend', 'edit_time', 'user_id', 'type_id', 'delete' ])
            ->order('edit_time desc')
            ->select();

        $num = 0;
        foreach ( $data as $v ) {
            //为了前端能正常识别，将文章和用户的关联数组进行数组转维
            $data[$num]['user_name'] = $v['get_user']['name'];
            $data[$num]['article_type_name'] = $v['get_article_type']['article_type_name'];
            //格式化时间戳
            $data[$num]['edit_time'] = date('Y-m-d H:i', $v['edit_time']);
            $num++;
        }
        $data['pages'] = $pages;

        return $data;
    }

    //文章置顶和推荐设置
    public function setArticleChecked ($data)
    {
        if ( array_key_exists('top', $data) ) $key = 'top';
        if ( array_key_exists('recommend', $data) ) $key = 'recommend';

        $data[$key] = $data[$key] == 'true' ? 1 : 0;
        $this->where('id', '=', $data['id'])->update($data);
        return $data[$key] == 1 ? 1 : 0;
    }

    /**
     * 添加操作
     * $coverDirShow 前端显示图片路径
     * $coverDirUpload 上传图片路径
     * @return \think\response\Json
     * 问题发现：因服务器原因，两者路径不一致
     */
    public function uploadArticleICover ()
    {
        //得到数据库最大的id，进行拼接缓存名称
        $this->articleId = $this->max('id') + 1;

        //获取当前请求的变量，得到一个Request实例
        $getCover = Request::instance()->file('cover');

        //检测文件是否有上传，如果有上传，则删除，并且删除原缓存
        if ( $old_file = Cache::get('article_cover_dir_upload_' . $this->articleId) ) {
            @unlink($old_file);
            Cache::rm('article_cover_dir_upload_' . $this->articleId);
        }
        //拼接上传目录
        $coverInfo = $getCover->move(UPLOAD_PATH . 'upload' . DS . 'article');
        //前端显示图片路径
        $coverDirShow = SHOW_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName();
        //上传图片路径
        $coverDirUpload = UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName();

        if ( !$coverDirUpload ) {
            $data = [
                'code' => 404,
                'msg' => '上传失败',
                'data' => [
                    'src' => '',
                ],
            ];
            return json($data);
        }
        // 生成缩略图
        $image = Image::open(UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName());
        // 替换原图
        $image->thumb(184.297, 97.406, Image::THUMB_FIXED)->save(UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName());


        Cache::set('article_cover_dir_show_' . $this->articleId, $coverDirShow);
        Cache::set('article_cover_dir_upload_' . $this->articleId, $coverDirUpload);

        $data = [
            'code' => 200,
            'msg' => '上传成功',
            'data' => [
                'src' => $coverDirShow,
            ],
        ];

        return json($data);
    }

    /**
     * 编辑操作
     * $coverDirShow 前端显示图片路径
     * $coverDirUpload 上传图片路径
     * @return \think\response\Json
     * 问题发现：因服务器原因，两者路径不一致
     */
    public function editArticleICover ()
    {
        //得到数据库最大的id，进行拼接缓存名称
        $id = Request::instance()->post('id');
        $articleId = $this->get($id)->id;

        //获取当前请求的变量，得到一个Request实例
        $getCover = Request::instance()->file('cover');

        //检测文件是否有上传，如果有上传，则删除，并且删除原缓存
        if ( $old_file = Cache::get('article_cover_dir_edit_' . $articleId) ) {
            @unlink($old_file);
            Cache::rm('article_cover_dir_edit_' . $articleId);
        }
        //拼接上传目录
        $coverInfo = $getCover->move(UPLOAD_PATH . 'upload' . DS . 'article');
        //前端显示图片路径
        $coverDirShow = SHOW_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName();
        //上传图片路径
        $coverDirUpload = UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName();

        if ( !$coverDirUpload ) {
            $data = [
                'code' => 404,
                'msg' => '上传失败',
                'data' => [
                    'src' => '',
                ],
            ];
            return json($data);
        }
        // 生成缩略图
        $image = Image::open(UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName());
        // 替换原图
        $image->thumb(184.297, 97.406, Image::THUMB_FIXED)->save(UPLOAD_PATH . 'upload' . DS . 'article' . DS . $coverInfo->getSaveName());


        Cache::set('article_cover_dir_edit_show_' . $articleId, $coverDirShow);
        Cache::set('article_cover_dir_edit_' . $articleId, $coverDirUpload);

        $data = [
            'code' => 200,
            'msg' => '上传成功',
            'data' => [
                'src' => $coverDirShow,
            ],
        ];

        return json($data);
    }


    /**
     * 文章添加
     * @param $data  文章数据
     * @return bool|string
     */
    public function addArticle ($data)
    {
        //置顶
        array_key_exists('top', $data) && ($data['top'] == 'on') ? $data['top'] = 1 : '';
        //推荐
        array_key_exists('recommend', $data) && ($data['recommend'] == 'on') ? $data['recommend'] = 1 : '';
        //编辑时间
        $data['edit_time'] = time();
        //文章封面
        $data['cover'] = $data['cover_src'];
        unset($data['cover_src']);
        //清理缓存
        Cache::rm('article_cover_dir_edit_show_' . $this->articleId);
        Cache::rm('article_cover_dir_edit_' . $this->articleId);
        //发布人
        $data['user_id'] = Session::get('id');

        $addRes = $this->data($data)->save();
        if ( 0 < $addRes ) {
            return true;
        } else {
            return '发布失败';
        }
    }

    /**
     * 文章编辑
     * @param $data  文章数据
     * @return bool|string
     */
    public function editArticle ($data)
    {
        //置顶
        array_key_exists('top', $data) && ($data['top'] == 'on') ? $data['top'] = 1 : $data['top'] = 0;
        //推荐
        array_key_exists('recommend', $data) && ($data['recommend'] == 'on') ? $data['recommend'] = 1 : $data['top'] = 0;
        //编辑时间
        $data['edit_time'] = time();


        //路有上传新图，则删除原图
        if ( !empty($data['cover_src']) ) {
            $old_img = $this->get($data['id'])->cover;
            @unlink('.' . $old_img);
            //清理缓存
            Cache::rm('article_cover_dir_edit_show_' . $this->articleId);
            Cache::rm('article_cover_dir_edit_' . $this->articleId);
            //文章封面
            $data['cover'] = $data['cover_src'];
            unset($data['cover_src']);
        } else {
            unset($data['cover_src']);
            unset($data['cover']);
        }
        //发布人
        $data['user_id'] = Session::get('id');

        $addRes = $this->save($data, $data['id']);
        if ( 0 < $addRes ) {
            return true;
        } else {
            return '发布失败';
        }
    }

    //文章删除到回收站
    public function deleteArticle ()
    {
        $id = Request::instance()->post('id');
        if ( $this->where('id', '=', $id)->update([ 'delete' => time() ]) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 文章回收站列表数据
     * @param $currentIndex 当前页
     * @param $pageSize 每页显示数量
     * @return false|\PDOStatement|string|\think\Collection 分页好的数据
     */
    public function getArticleRecycleListData ($currentIndex, $pageSize)
    {
        //总记录数
        $count = $this->where('delete', 'neq', '')->count();
        //总页数 = ceil(总记录数 / 每页显示数量)
        $pages = ceil($count / $pageSize);
        //分页  limit( 每页数量 * ( 当前页 - 1 ) , 每页显示数)
        $data = $this->with('getUser,getArticleType')
            ->where('delete', 'neq', '')
            ->limit($pageSize * ($currentIndex - 1), $pageSize)
            ->field([ 'id', 'title', 'top', 'recommend', 'edit_time', 'user_id', 'type_id' ])
            ->select();

        $num = 0;
        foreach ( $data as $v ) {
            //为了前端能正常识别，将文章和用户的关联数组进行数组转维
            $data[$num]['user_name'] = $v['get_user']['name'];
            $data[$num]['article_type_name'] = $v['get_article_type']['article_type_name'];
            //格式化时间戳
            $data[$num]['edit_time'] = date('Y-m-d H:i', $v['edit_time']);
            $num++;
        }
        $data['pages'] = $pages;

        return $data;
    }


    //文章回收站删除
    public function deleteArticleRecycle ()
    {
        $id = Request::instance()->post('id');
        if ( $this->where('id', '=', $id)->delete() ) {
            return true;
        } else {
            return false;
        }
    }


    //文章回收站恢复
    public function recoveryArticleRecycle ()
    {
        $id = Request::instance()->post('id');
        if ( $this->where('id', '=', $id)->update([ 'delete' => null ]) ) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 获取文章评论数据（不含回复）
     * @currentIndex 当前页下标
     * @pageSize 每页显示条数
     * @return data 分页好的数据
     */
    public function getCommentData ($currentIndex, $pageSize)
    {
        $count = Db::table('blog_article_comment')//总记录数
            ->where('pid', '=', 0)
            ->count();
        $pages = ceil($count / $pageSize);              //总页数
        $data = Db::table('blog_article_comment')       //已分页数据
            ->alias('comm')
            ->join('blog_article art','comm.article_id=art.id')
            ->where('pid', '=', 0)
            ->limit($pageSize * ($currentIndex - 1), $pageSize)
            ->field('comm.id,comm.name,comm.content,comm.time,comm.ip,comm.pid,art.title')
            ->order('time desc')
            ->select();
        foreach ( $data as &$v ) {
            $v['time'] = date('Y-m-d H:i', $v['time']);
            $v['content'] = htmlspecialchars_decode($v['content']);
        }
        $data['pages'] = $pages;
        return $data;
    }

    //获取文章评论回复数据
    public function getCommentReply ()
    {
        $id = Request::instance()->param('id');
        $data = Db::table('blog_article_comment')//已分页数据
            ->where('pid', '<>', 0)
            ->where('pid', '=', $id)
            ->select();
        foreach ( $data as &$v ) {
            $v['time'] = date('Y-m-d H:i', $v['time']);
            $v['content'] = htmlspecialchars_decode($v['content']);
        }
        return $data;
    }

    //删除文章评论
    public function deleteComment ()
    {
        $id = Request::instance()->param('id');
        $result = Db::table('blog_article_comment')->where('id', '=', $id)->delete();
        Db::table('blog_article_comment')->where('pid', '=', $id)->delete();
        if ( !$result ) {
            return false;
        }
        return true;
    }

    //删除文章评论回复
    public function deleteCommentReply ()
    {
        $id = Request::instance()->param('id');
        $result = Db::table('blog_article_comment')->where('id', '=', $id)->delete();
        if ( !$result ) {
            return false;
        }
        return true;
    }
}