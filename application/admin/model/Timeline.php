<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:50
 */

namespace app\admin\model;


use think\Request;

class Timeline extends BaseModel
{
    //关联User表
    public function getUser(){
        return $this->hasOne('User','id','user_id')->field('id,name');
    }

    /**
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 分页好的数据
     */
    public function getTimelineData($currentIndex, $pageSize){
        $count = $this->count();            //总记录数
        $pages = ceil($count/$pageSize);    //总页数
        $data = $this->with('getUser')->limit($pageSize * ($currentIndex - 1),$pageSize)->select();
        //重新分配数组中的user表的数据
        $num = 0;
        foreach($data as $v){
            $data[$num]['edit_time'] = date('Y年m月d日 H:i',$v['edit_time']);
            $data[$num]['user_name'] = $v['get_user']['name'];
            $num++;
        }
        $data['pages'] = $pages;
        return $data;
    }

    public function deleteTimeline(){
        $id = Request::instance()->param();
        $deleteRes = $this->where('id','=',$id['id'])->delete();
        if($deleteRes){
            return true;
        }else{
            return false;
        }
    }
}