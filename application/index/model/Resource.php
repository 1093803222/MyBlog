<?php
/**
 * Created by 信磊.
 * Date: 2017/8/8
 * Time: 19:15
 */

namespace app\index\model;


class Resource extends BaseModel
{
    public function getUser(){
        return $this->hasOne('User','id','user_id')->field('id,name');
    }
    public function getType(){
        return $this->hasOne('ResourceType','id','type_id');
    }

    public function getResource($type_id){
        $data = $this->with('getUser,getType')
            ->where("`delete` is null OR `delete` = ''")
            ->where('type_id','LIKE',$type_id)
            ->select();
        $num = 0;
        foreach ($data as $v) {
            $data[$num]['user_name'] = $v['get_user']['name'];
            $data[$num]['resource_type_name'] = $v['get_type']['resource_type_name'];
            //格式化时间戳
            $data[$num]['edit_time'] = date('Y-m-d H:i', $v['edit_time']);
            unset($data[$num]['get_type']);
            unset($data[$num]['get_user']);
            unset($data[$num]['user_id']);
            $num++;
        }
        return json($data);
    }
}