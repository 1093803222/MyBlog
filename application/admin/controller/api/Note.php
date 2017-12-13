<?php
/**
 * Created by 信磊.
 * Date: 2017/7/28
 * Time: 18:49
 */

namespace app\admin\controller\api;

use app\admin\controller\show\BaseController;
use app\admin\model\Note as NoteModel;

class Note extends BaseController
{
    /**
     * 笔记列表数据
     * @param NoteModel $noteModel
     * @param $currentIndex 当前页下标
     * @param $pageSize 每页显示条数
     * @return data 笔记列表数据，包含分页
     */
    public function noteApi(NoteModel $noteModel,$currentIndex,$pageSize){
        //获取笔记列表
        return $noteModel->getNoteData($currentIndex,$pageSize);;
    }

    //删除笔记
    public function deleteNoteApi(NoteModel $noteModel){
        return $noteModel->deleteNote();
    }
}