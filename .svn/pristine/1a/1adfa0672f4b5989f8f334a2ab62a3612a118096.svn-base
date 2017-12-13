<?php
/**
 * Created by 信磊.
 * Date: 2017/8/23
 * Time: 16:12
 */

namespace app\index\model;


class ArticleComment extends BaseModel
{
    public function comment($pid = 0, $content)
    {
        //判断是否登陆
        if (isset(session('weibo')['name'])) {
            $data['content'] = $content;                            //留言内容
            $data['name'] = session('weibo')['name'];               //留言人昵称
            $data['top'] = session('weibo')['profile_image_url'];   //留言人头像
            $data['time'] = time();                                 //留言时间
            $data['ip'] = request()->ip();                          //留言人ip
            $data['pid'] = $pid;                                    //上级留言id
            $data['article_id'] = input('article_id');                                    //上级留言id
            //储存留言信息
            $remarkResult = self::create($data);
            //取得插入数据后返回的id
            $remark['id'] = $remarkResult->id;
            if ($remark['id']) {
                $remark['name'] = $data['name'];
                $remark['top'] = $data['top'];
                $remark['time'] = date('Y-m-d H:i', $data['time']);
                return json($remark);
            }
            return json('', 500);
        } elseif (session('nickname')) {
            $data['content'] = $content;                            //留言内容
            $data['name'] = session('nickname');               //留言人昵称
            $data['top'] = session('figureurl');                //留言人头像
            $data['time'] = time();                                 //留言时间
            $data['ip'] = request()->ip();                          //留言人ip
            $data['pid'] = $pid;                                    //上级留言id
            $data['article_id'] = input('article_id');                                    //上级留言id
            //储存留言信息
            $remarkResult = self::create($data);
            //取得插入数据后返回的id
            $remark['id'] = $remarkResult->id;
            if ($remark['id']) {
                $remark['name'] = $data['name'];
                $remark['top'] = $data['top'];
                $remark['time'] = date('Y-m-d H:i', $data['time']);
                return json($remark);
            }
            return json('', 500);
        } else {
            return false;
        }
    }

    //查询留言信息
    public function getArticleCommentData($pageSize = 0)
    {
        $data['parent'] = $this->order('time desc')
            ->where('pid','=','0')
            ->where('article_id','=',input('id'))
            ->limit($pageSize,3)
            ->select();
        foreach($data['parent'] as &$value){
            $value['content'] =  htmlspecialchars_decode($value['content']);
            $value['time'] =  date('Y-m-d H:i', $value['time']);
        }

        $data['child'] = $this->order('time desc')
            ->where('pid','<>','0')
            ->where('article_id','=',input('id'))
            ->select();
        foreach($data['child'] as &$value){
            $value['time'] =  date('Y-m-d H:i', $value['time']);
        }
        return $data;
    }
}