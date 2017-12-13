<?php
/**
 * Created by 信磊.
 * Date: 2017/8/9
 * Time: 23:55
 */

namespace app\index\model;


class Timeline extends BaseModel
{
    public function getTimelineData()
    {
        static $year = [];
        static $month = [];
        static $data_new = [];
        $html = '';
        $data = $this->order('edit_time desc')->select();
        $num = 0;
        foreach ($data as $v) {
            $data[$num]['year'] = date('Y', $v['edit_time']);
            $data[$num]['month'] = date('m', $v['edit_time']);
            $data[$num]['day'] = date('d', $v['edit_time']);
            $year[date('Y', $v['edit_time'])] = [];
            $month[date('m', $v['edit_time'])] = [];
            $num++;
        }
        foreach ($data as $v) {
            //查找该年份下的所有数据
            if (in_array($v['year'], array_keys($year))) {
                //查找该月份下的所有数据
                if (in_array($v['month'], array_keys($month))) {
                    //把得到的数据存入该月份中
                    $data_new[$v['year']][$v['month']][] = $v;
                }
            }
        }

        $num2 = 1;
        $html .= '<div class="timeline-main">
                        <h1><i class="fa fa-clock-o"></i>时光轴<span> —— 生活点点滴滴</span></h1>
                        <div class="timeline-line"></div>';
        foreach ($data_new as $year => $value) {
            $right = $num2 == 1 || $num2 == 2 ? 'down' : 'right';
            $style = $num2 == 1 || $num2 == 2 ? 'style="display: block;"' : 'style="display: none;"';
            $html .= '<div class="timeline-year">
                        <h2><a class="yearToggle" href="javascript:;">' . $year . '年</a><i class="fa fa-caret-' . $right . ' fa-fw"></i></h2>';
            foreach ($value as $month => $value2) {
                $html .= '
                    <div class="timeline-month" ' . $style . '>
                        <h3 class=" animated fadeInLeft" ><a class="monthToggle" href = "javascript:;" >' . $month . '月 </a ><i class="fa fa-caret-down fa-fw" ></i ></h3 >
                        <ul >';
                foreach ($value2 as $data) {
                    $data['content'] = htmlspecialchars_decode($data['content']);
                    $html .= '<li class=" " >
                                <div class="h4  animated fadeInLeft" >
                                    <p class="date" > ' . date('m月d日 H:i', $data['edit_time']) . ' </p >
                                </div >
                                <p class="dot-circle animated " ><i class="fa fa-dot-circle-o" ></i ></p >
                                <div class="content animated fadeInRight" > ' . $data['content'] . '</div >
                                <div class="clear" ></div >
                            </li >';
                }
                $html .= ' </ul >
                    </div >';
            }
            $html .= '</div>';
            $num2++;
        }
        $html .= '<h1 style="padding-top:4px;padding-bottom:2px;margin-top:40px;"><i class="fa fa-hourglass-end"></i>THE END</h1></div>';
        return $html;
    }

    public function setTimeline(){
        $content = input('post.content');
        $data = [
            'content' => $content,
            'edit_time' => time(),
            'user_id' => 1
        ];
        $result = $this->data($data)->save();
        if($result){
            //发表成功，及时返回最新生活记录
            return $this->getTimelineData();
        }else{
            return 0;
        }
    }
}