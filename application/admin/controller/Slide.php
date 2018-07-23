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

}