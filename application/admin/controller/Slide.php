<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/23
 * Time: 上午12:21
 */

namespace app\admin\controller;

use app\admin\model\NewsModel;
use app\admin\model\SlideModel;


/**
 * Class Slide
 * @package app\admin\controller
 */
class Slide extends CommonController
{

    /**
     *  默认显示list
     */
    public function index()
    {
        return $this->list();
    }

    /**
     *   list
     */
    public function list()
    {
        $map = [];
        $count = SlideModel::getSlideCount();
        $size = 5;
        $paginate = SlideModel::getSlidePaginate($map, $size, $count)->each(function ($item, $key) {
            $news = NewsModel::getNewsById($item->news_id);
            $item['title'] = $news->title;
            $item['column'] = $news->column;
            $item['copyfrom'] = $news->copyfrom;
            $item['thumb'] = $news->thumb;
            return $item;
        });
        $this->assign('slides', $paginate);
        return $this->fetch('index/slide/list');
    }


    /*
   insert to slide
    */
    public function insert()
    {
        if (!$_POST && !isset($_POST['slide'])) {
            return show('0', '没有选上');
        }
        $success = '';
        $error = '';
        $exist = '';
        $data = [];
        foreach ($_POST['slide'] as $item) {
            if (SlideModel::getSlideByNewsId($item)) {
                $exist .= $item . ' ';
            } elseif (NewsModel::getNewsById($item)) {
                $result = SlideModel::insertSlide($item);
                if ($result) {
                    $success .= $item . ' ';
                } else {
                    $error .= $item . ' ';
                }
            }
        }
        $data['success'] = $success;
        $data['error'] = $error;
        $data['exist'] = $exist;
        return show('1', '', $data);
    }

    /*
   update listorder
    */
    public function listorder()
    {
        if (!$_POST) {
            return $this->redirect('list');
        }
        try {
            $id = intval($_POST['id']);
            $listorder = intval($_POST['listorder']);
            $result = SlideModel::updateSlideById($id, ['listorder' => $listorder]);
            if ($result)
                return show(1, "更新排序成功");
            else
                return show(0, "更新没有变化");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    /**
     *   delete
     */
    public function delete()
    {
        if (!$_POST) {
            return $this->redirect('list');
        } elseif (!isset($_POST['id'])) {
            return show('0', '数据有误');
        }
        //删除操作，实际上是status变-1
        $id = $_POST['id'];
        $del_array = array('status' => '-1');
        try {
            $del_result = SlideModel::updateSlideById($id, $del_array);
            if ($del_result) {
                return show('1', '删除成功');
            }
            return show('0', '删除失败');
        } catch (Exception $e) {
            return show('0', $e->getMessage());
        }
    }


}