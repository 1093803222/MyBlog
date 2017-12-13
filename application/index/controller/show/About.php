<?php
/**
 * Created by 信磊.
 * Date: 2017/8/4
 * Time: 16:20
 */

namespace app\index\controller\show;

use app\index\model\Message;
use think\Db;
use think\View;

class About extends BaseController
{
    public function index(Message $message)
    {
        //查找关于作者
        $authorAbout = Db::table('blog_author_about')->find();
        //查找友情链接
        $linkAbout = Db::table('blog_link_about')->find();
        //查找友情链接列表
        $link = Db::table('blog_link')->select();
        //查找留言内容
        $message =$message->getRemarkData();
        View::share([
            'authorAbout' => $authorAbout,
            'linkAbout' => $linkAbout,
            'link' => $link,
            'message' => $message
            ]);
        return view();
    }

}