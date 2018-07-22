<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/23
 * Time: 上午12:21
 */

namespace app\admin\controller;


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
        if (!$_POST) {
            return $this->redirect('list');
        }elseif (!isset($_POST['slide'])) {
            return show('0', '数据有误');
        }
        dump($_POST);
    }

}