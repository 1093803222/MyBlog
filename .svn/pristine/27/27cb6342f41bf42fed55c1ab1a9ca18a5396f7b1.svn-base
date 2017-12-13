<?php
/**
 * Created by 信磊.
 * Date: 2017/8/13
 * Time: 20:30
 */

namespace app\admin\model;

use think\Db;
use think\Image;
use think\Loader;
use think\Request;

class About extends BaseModel
{
    public function updateAuthorAbout()
    {
        $data = Request::instance()->param();
        if ($data['P1'] == '全部') {
            unset($data['P1']);
            unset($data['C1']);
            unset($data['A1']);
        } else {
            $data['address'] = $data['P1'] . ' - ' . $data['C1'] . ' - ' . $data['A1'];
            unset($data['P1']);
            unset($data['C1']);
            unset($data['A1']);
        }
        $result = Db::table('blog_author_about')->where('category', '=', '关于作者')->update($data);
        if ($result) {
            return true;
        } else {
            return '更新失败';
        }
    }


    public function uploadImg()
    {
        $file         = Request::instance()->file('top_img');
        //上传后移动文件夹
        $imgInfo      = $file->move(UPLOAD_PATH . 'upload' . DS . 'about');
        //前端显示图片路径
        $imgDirShow   = SHOW_PATH . 'upload' . DS . 'about' . DS . $imgInfo->getSaveName();
        //上传图片路径
        $imgDirUpload = UPLOAD_PATH . 'upload' . DS . 'about' . DS . $imgInfo->getSaveName();
        //判断是否上传成功
        if (is_file($imgDirUpload)) {
            //删除旧图片
            $topImg = Db::table('blog_author_about')->value('top_img');
            @unlink('.' . $topImg);
            //更新数据库
            Db::table('blog_author_about')->where('category', '=', '关于作者')->update(['top_img' => $imgDirShow]);
            return json(['code' => 200, 'msg' => '上传成功', 'data' => ['src' => $imgDirShow]]);
        } else {
            return json(['code' => 500, 'msg' => '上传失败', 'data' => []]);
        }
    }

    public function updateLinkAbout()
    {
        $data = Request::instance()->param();
        $result = Db::table('blog_link_about')->where('name', '=', '友情链接')->update($data);
        if ($result !== false) {
            return true;
        } else {
            return '更新失败';
        }
    }

    //添加友情链接
    public function addLink()
    {
        $file     = Request::instance()->file('link_img');
        $data     = Request::instance()->param();
        //验证表单
        $validate = Loader::validate('Link');
        if(!$validate->check($data)){
            $resultData = ['code' => 400, 'msg' => $validate->getError(), 'data' => []];
            return $resultData;
        }
        $imgInfo = $file->validate(['ext'=>'jpg,jpeg,icon,png,gif'])
                        ->move(UPLOAD_PATH . 'upload' . DS . 'link');
        if(!$imgInfo){
            $resultData = ['code' => 400, 'msg' => $file->getError(), 'data' => []];
            return $resultData;
        }
        //前端显示图片路径
        $imgDirShow = SHOW_PATH . 'upload' . DS . 'link' . DS . $imgInfo->getSaveName();
        //上传图片路径
        $imgDirUpload = UPLOAD_PATH . 'upload' . DS . 'link' . DS . $imgInfo->getSaveName();
        //生成缩略图
        $image = Image::open($imgDirUpload);
        // 按照原图的比例生成一个固定尺寸为150*150的缩略图并保存替换
        $image->thumb(150, 150, Image::THUMB_FIXED)->save($imgDirUpload);
        //判断是否上传成功
        if (is_file($imgDirUpload)) {
            $data['link_img'] = $imgDirShow;
            //添加数据
            $result = Db::table('blog_link')->insert($data);
            if ($result) {
                $html = <<<HTML
                <li>
                    <a target="_blank" href="{$data['link_url']}" title="{$data['link_name']}" class="friendlink-item">
                        <p class="friendlink-item-pic"><img src="{$data['link_img']}" alt="{$data['link_name']}" /></p>
                        <p class="friendlink-item-title">{$data['link_name']}</p>
                        <p class="friendlink-item-domain">{$data['link_url']}</p>
                    </a>
                </li>
HTML;
                $resultData = ['code' => 200, 'msg' => '添加成功', 'data' => $html];
                return $resultData;
            } else {
                $resultData = ['code' => 500, 'msg' => '添加失败', 'data' => []];
                return $resultData;
            }
        } else {
            $resultData = ['code' => 500, 'msg' => '添加失败', 'data' => []];
            return $resultData;
        }
    }

    /**
     * 获取留言数据（不含回复）
     * @currentIndex 当前页下标
     * @pageSize 每页显示条数
     * @return data 分页好的数据
     */
    public function getMessageData($currentIndex,$pageSize){
        $count = Db::table('blog_message')              //总记录数
            ->where('pid','=',0)
            ->count();
        $pages = ceil($count / $pageSize);              //总页数
        $data  =  Db::table('blog_message')             //已分页数据
            ->where('pid','=',0)
            ->limit($pageSize * ($currentIndex - 1), $pageSize)
            ->select();
        foreach ( $data as &$v ){
            $v['time']    = date('Y-m-d H:i', $v['time']);
            $v['content'] = htmlspecialchars_decode($v['content']);
        }
        $data['pages'] = $pages;
        return $data;
    }

    //获取回复数据
    public function getMessageReply(){
        $id = Request::instance()->param('id');
        $data  =  Db::table('blog_message')             //已分页数据
            ->where('pid','<>',0)
            ->where('pid', '=', $id)
            ->select();
        foreach ( $data as &$v ){
            $v['time']    = date('Y-m-d H:i', $v['time']);
            $v['content'] = htmlspecialchars_decode($v['content']);
        }
        return $data;
    }

    //删除留言回复
    public function deleteMessage(){
        $id = Request::instance()->param('id');
        $result = Db::table('blog_message')->where('id','=',$id)->delete();
                  Db::table('blog_message')->where('pid','=',$id)->delete();
        if(!$result){
            return false;
        }
        return true;
    }
    //删除留言回复
    public function deleteMessageReply(){
        $id = Request::instance()->param('id');
        $result = Db::table('blog_message')->where('id','=',$id)->delete();
        if(!$result){
            return false;
        }
        return true;
    }
}