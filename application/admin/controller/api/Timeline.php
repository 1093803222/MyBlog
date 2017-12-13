<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:49
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use app\admin\model\Timeline as TimelineModel;

class Timeline extends BaseController
{
    /**
     * 时光轴列表数据
     * @param TimelineModel $timelineModel
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 时光轴列表数据，包含分页
     */
    public function timelineApi(TimelineModel $timelineModel,$currentIndex,$pageSize){
        //获取时光轴列表
        return $timelineModel->getTimelineData($currentIndex,$pageSize);;
    }

    //删除时光轴
    public function deleteTimelineApi(TimelineModel $timelineModel){
        return $timelineModel->deleteTimeline();
    }
}