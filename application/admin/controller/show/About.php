<?php
/**
 * Created by 信磊.
 * Date: 2017/8/12
 * Time: 17:32
 */

namespace app\admin\controller\show;


use think\Db;
use think\View;

class About extends BaseController
{
    //关于作者页面
    public function aboutAuthor ()
    {
        $authorData = Db::table('blog_author_about')->find();
        View::share('authorData', $authorData);
        return view();
    }

    //友情链接页面
    public function aboutLink ()
    {
        $linkData = Db::table('blog_link_about')->find();
        $link = Db::table('blog_link')->select();
        View::share([ 'linkData' => $linkData, 'link' => $link ]);
        return view();
    }

    //留言页面
    public function aboutMessage ()
    {
        return view('aboutMessageList');
    }
    //留言回复页面
    public function aboutMessageReply ($id)
    {
        View::share('id', $id);
        return view('aboutMessageReply');
    }
}