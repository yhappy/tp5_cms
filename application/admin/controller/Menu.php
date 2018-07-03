<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/18
 * Time: 下午8:31
 */

namespace app\admin\controller;

use app\admin\model\MenuModel;
use think\Exception;

/**
 * Class Menu
 * @package app\admin\controller
 */
class Menu extends CommonController
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
        $menu_type = -1;
        if (isset($_GET['type']) && in_array($_GET['type'], array(-1, 0, 1))) {
            $menu_type = intval($_GET['type']);
            cookie('type', $menu_type);
        } elseif (isset($_COOKIE['type']) && in_array($_COOKIE['type'], array(-1, 0, 1))) {
            $menu_type = intval($_COOKIE['type']);
        }
        if ($menu_type >= 0) {
            $map['menu_type'] = $menu_type;
        }
        $menus_count = MenuModel::getMenusCount($map);
        $paginate = MenuModel::getMenuPaginate($map, 4, $menus_count);
        $this->assign('list', $paginate);
        $this->assign('type', $menu_type);
        return $this->fetch('index/menu/list');
    }

    /**
     *   add
     */
    public function add()
    {
        if ($_POST) {
            if (!(isset($_POST['menu_name']) && $_POST['menu_name'])) {
                return show('0', '菜单名字不能为空');
            }
            if (!(isset($_POST['model_name']) && $_POST['model_name'])) {
                return show('0', '模块名字不能为空');
            }
            if (!(isset($_POST['controller_name']) && $_POST['controller_name'])) {
                return show('0', '控制器名字不能为空');
            }
            if (!(isset($_POST['func_name']) && $_POST['func_name'])) {
                return show('0', '方法名字不能为空');
            }
            if (isset($_POST['id'])) {
                return $this->update($_POST);
            }
            //添加操作
            $add_result = MenuModel::insertMenu($_POST);
            if ($add_result) {
                return show('1', '添加成功');
            }
            return show('0', '添加失败');

        }
        return $this->fetch('index/menu/add');
    }


    /**
     *   edit
     */
    public function edit()
    {
        if ($_GET && isset($_GET['id'])) {
            $id = $_GET['id'];
            $one_menu = MenuModel::getMenuById($id);
            $this->assign('menu', $one_menu);
            return $this->fetch('index/menu/edit');
        }

//        return $this->redirect('list');
    }

    /**
     *   update
     */
    public function update(array $post)
    {
        //更新操作
        try {
            $updt_result = MenuModel::updateMenuById($post['id'], $post);
            if ($updt_result) {
                return show('1', '更新成功');
            }
            return show('0', '没有更改');
        } catch (Exception $e) {
            return show('0', $e->getMessage());
        }
    }

    /**
     *   delete
     */
    public function delete()
    {
        if (!$_POST)
        {
//            return $this->redirect('list');
        }
        elseif (!isset($_POST['id']))
        {
            return show('0', '数据有误');
        }
        //删除操作，实际上是status变-1
        $id = $_POST['id'];
        $del_array = array('status' => '-1');
        try {
            $del_result = MenuModel::updateMenuById($id, $del_array);
            if ($del_result) {
                return show('1', '删除成功');
            }
            return show('0', '删除失败');
        } catch (Exception $e) {
            return show('0', $e->getMessage());
        }
    }

    /*
    update listorder
     */
    public function listorder()
    {
        $temp = false;
        if (!$_POST)
        {
//            return $this->redirect('list');
        }
        try {
            foreach ($_POST as $id => $value) 
            {
                $id = intval($id);
                $result = MenuModel::updateMenuById($id, ['listorder' => $value]);
                $temp = $temp || $result;
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        if ($temp)
            return show(1 , "更新排序成功");
        else
            return show(0 , "更新没有变化");
    }
}