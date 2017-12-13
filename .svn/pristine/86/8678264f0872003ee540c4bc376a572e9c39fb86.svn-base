<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:50
 */

namespace app\admin\model;


use think\Request;

class ResourceType extends BaseModel
{
    /**
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 分页好的数据
     */
    public function getResourceTypeListData($currentIndex, $pageSize){
        $count = $this->count();            //总记录数
        $pages = ceil($count/$pageSize);    //总页数
        $data = $this->limit($pageSize * ($currentIndex - 1),$pageSize)->select();
        $data['pages'] = $pages;
        return $data;
    }

    /**
     * @param $typeName 表单参数
     * @return bool
     */
    public function addResourceType($typeName)
    {
        $addResult = $this->data($typeName)->save();
        if (0 < $addResult) {
            return true;
        } else {
            return '添加失败';
        }
    }
    //根据id查询一条资源分类数据
    public function getResourceTypeOne($id){
        return $this->find($id);
    }
    //获得所有资源分类数据
    public function getResourceTypeAll(){
        return $this->select();
    }

    /**
     * @param $data 表单参数
     * @return bool
     */
    public function editResourceType($data)
    {
        $addResult = $this->update($data);
        if ($addResult) {
            return true;
        } else {
            return '修改失败';
        }
    }

    public function deleteResourceType(){
        $id = Request::instance()->param();
        $deleteRes = $this->where('id','=',$id['id'])->delete();
        if($deleteRes){
            return true;
        }else{
            return false;
        }
    }
}