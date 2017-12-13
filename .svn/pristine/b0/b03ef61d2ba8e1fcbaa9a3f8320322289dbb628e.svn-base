<?php
/**
 * Created by 信磊.
 * Date: 2017/8/9
 * Time: 23:54
 */

namespace app\index\controller\api;


use app\index\controller\show\BaseController;
use app\index\model\Timeline as TimelineModel;

class Timeline extends BaseController
{
    public function getTimelineApi(TimelineModel $timelineModel)
    {
        return $timelineModel->getTimelineData();
    }

    //发表生活记录
    public function setTimelineApi(TimelineModel $timelineModel){
        return $timelineModel->setTimeline();
    }
}