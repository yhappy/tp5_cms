<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/18
 * Time: 下午8:31
 */

namespace app\admin\controller;

/**
 * Class Menu
 * @package app\admin\controller
 */
class Menu extends Commoncontroller
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
        return $this->fetch('index/menu/list');
    }
}