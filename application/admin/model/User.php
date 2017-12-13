<?php
/**
 * Created by 信磊.
 * Date: 2017/7/24
 * Time: 22:31
 */

namespace app\admin\model;


class User extends BaseModel
{
    //隐藏无用的字段
//    protected $hidden = ['email','password','power_group_id','register_time','register_ip'];
    //关联PowerGroup
    public function getPowerGroup(){
       return $this->hasOne('PowerGroup','id','power_group_id');
    }

    /**
     * @param $currentIndex  当前页
     * @param $pageSize    每页数
     * @return \think\response\Json
     */
    public function getUserList($currentIndex, $pageSize){
        $count = $this->with('getPowerGroup')->count(); //总记录数
        $pages = ceil($count/$pageSize);        //总页数
        $data  =  $this->with('getPowerGroup')
            ->limit($pageSize * ($currentIndex - 1),$pageSize)
            ->field(['id','account','name','login_time','login_ip','blacklist'])
            ->select();
        foreach($data as $k=>$v){
            //格式化时间戳
            $data[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
        }
        $data['pages'] = $pages;
        return json($data);
    }

    //设置黑名单
    public function setBlackList($data){
        $this->update($data);
    }

    //添加数据
    public static function setAddUser($data){
        unset($data['isPassword']); //去除确认密码字段
        $data['register_time'] = time();
        $data['register_ip']   = $_SERVER['REMOTE_ADDR'];
        $data['password']      = md5($data['password']); //md5加密
        $result = self::create($data);
        return $result;
    }
    //得到一条待编辑用户数据
    public function getUserOne($id){
        return $this->field(['id','account','name','email','power_group_id'])->find($id);
    }
    //更新数据
    public static function setEditUser($data){
        //如果密码为空，则不进行密码修改
        if(in_array('password',$data) || empty($data['password'])){
            unset($data['password']); //去除密码字段
        }else{
            $data['password'] = md5($data['password']);
        }

        unset($data['isPassword']); //去除确认密码字段

        $data['register_time'] = time();
        $data['register_ip']   = $_SERVER['REMOTE_ADDR'];
        $result = self::where('id','=',$data['id'])->update($data);
        return $result;
    }

}