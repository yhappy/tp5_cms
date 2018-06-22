<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/18
 * Time: 下午8:31
 */

namespace app\admin\controller;
use app\admin\model\MenuModel;

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

    /**
     *   add
     */
    public function add()
    {
        if ($_POST)
        {
            if(!(isset($_POST['menu_name']) && $_POST['menu_name']))
            {
                return show('0','菜单名字不能为空');
            }
            if(!(isset($_POST['model_name']) && $_POST['model_name']))
            {
                return show('0','模块名字不能为空');
            }
            if(!(isset($_POST['controller_name']) && $_POST['controller_name']))
            {
                return show('0','控制器名字不能为空');
            }
            if(!(isset($_POST['func_name']) && $_POST['func_name']))
            {
                return show('0','方法名字不能为空');
            }
            //添加操作
            $add_result = MenuModel::insert_Menu($_POST);
            if ($add_result)
            {
                return show('1', '添加成功' . $add_result);
            }

        }
        return $this->fetch('index/menu/add');
    }
}