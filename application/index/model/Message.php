<?php
/**
 * Created by 信磊.
 * Date: 2017/8/20
 * Time: 16:49
 */

namespace app\index\model;


class Message extends BaseModel
{
    public function remark($pid = 0, $content)
    {
        //判断是否登陆
        if (isset(session('weibo')['name'])) {
            $data['content'] = $content;                                     //留言内容
            $data['name']    = session('weibo')['name'];               //留言人昵称
            $data['top']     = session('weibo')['profile_image_url'];  //留言人头像
            $data['time']    = time();                                       //留言时间
            $data['ip']      = request()->ip();                              //留言人ip
            $data['pid']     = $pid;                                         //上级留言id
            //储存留言信息
            $remarkResult = self::create($data);
            //取得插入数据后返回的id
            $remark['id'] = $remarkResult->id;
            if ($remark['id']) {
                $remark['name'] = $data['name'];
                $remark['top']  = $data['top'];
                $remark['time'] = date('Y-m-d H:i', $data['time']);
                return json($remark);
            }
            return json('', 500);
        }elseif(session('login_type') == 'qq' && session('nickname')){
            $data['content'] = $content;                                //留言内容
            $data['name']    = session('nickname');               //留言人昵称
            $data['top']     = session('figureurl');              //留言人头像
            $data['time']    = time();                                  //留言时间
            $data['ip']      = request()->ip();                         //留言人ip
            $data['pid']     = $pid;                                    //上级留言id
            //储存留言信息
            $remarkResult = self::create($data);
            //取得插入数据后返回的id
            $remark['id'] = $remarkResult->id;
            if ($remark['id']) {
                $remark['name'] = $data['name'];
                $remark['top']  = $data['top'];
                $remark['time'] = date('Y-m-d H:i', $data['time']);
                return json($remark);
            }
            return json('', 500);
        } else {
            return false;
        }
    }

    //查询留言信息
    public function getRemarkData($pageSize = 0)
    {
        $data['parent'] = $this->order('time desc')->where('pid','=','0')->limit($pageSize,3)->select();
        foreach($data['parent'] as &$value){
            $value['content'] =  htmlspecialchars_decode($value['content']);
            $value['time']    =  date('Y-m-d H:i', $value['time']);
        }

        $data['child'] = $this->order('time desc')->where('pid','<>','0')->select();
        foreach($data['child'] as &$value){
            $value['time'] =  date('Y-m-d H:i', $value['time']);
        }
        return $data;
    }

    /**
     * -------------------------------------
     * 无限级留言（已废除）
     * @data 所有留言数据
     * @id  上级分类id
     * @return array
     * -------------------------------------
     */
    public function sortRemark($data, $id = 0)
    {
        //定义静态数组存取分类后的数据
        static $arr = array();
        foreach($data as $k => $v){
            $v['content'] = htmlspecialchars_decode($v['content']);
            if($v['pid'] == $id){
                $arr[] = $v;
                $this->sortRemark($data, $v['id']);
            }
        }
        return $arr;
    }
}