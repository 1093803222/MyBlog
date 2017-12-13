<?php
/**
 * Created by 信磊.
 * Date: 2017/8/6
 * Time: 15:08
 */

namespace app\index\model;


class Article extends BaseModel
{
    //关联文章分类
    public function getArticleType()
    {
        return $this->hasOne('ArticleType', 'id', 'type_id');
    }

    //关联用户
    public function getUser()
    {
        return $this->hasOne('User', 'id', 'user_id')->field('id,name');
    }

    public function getArticle()
    {
        $id = input('param.id');
        $data = $this->alias('a')
            ->join('user u', 'a.user_id=u.id', 'LEFT')
            ->field('a.id,a.title,a.content,a.description,a.cover,a.edit_time,a.click,a.delete,u.name')
            ->find($id);
        $this->update(['id'=>$id,'click'=>$data['click']+1]);  //每点击一次增加1个点击量
        $data['edit_time'] = date('Y/m/d H:i', $data['edit_time']); //转换时间戳
        $data['content'] = htmlspecialchars_decode($data['content']); //解码文章内容
        if ($data['delete'] != '' || $data['delete'] != null) {
            $html = <<<HTML
        <div class="article-detail shadow">
                        <div class="article-detail-title">
                            暂无文章数据
                        </div>
                        
                    </div>
HTML;
        } else {
            $html = <<<HTML
                <div class="article-detail shadow">
                    <div class="article-detail-title">
                        {$data['title']}
                    </div>
                    <div class="article-detail-info">
                        <span>编辑时间：{$data['edit_time']}</span>
                        <span>作者：{$data['name']}</span>
                        <span>浏览量：{$data['click']}</span>
                    </div>
                    <div class="article-detail-content">
                        <!-- 文章内容 -->
                        {$data['content']}
                    </div>
                </div>
HTML;
        }


        return $html;
    }

}