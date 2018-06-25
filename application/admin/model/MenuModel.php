<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/22
 * Time: 下午11:28
 */

namespace app\admin\model;

use think\Model;


class MenuModel extends model
{
    protected $table = 'cms_menu';

    public static function insertMenu(array $menu_array)
    {
        if (!$menu_array || !is_array($menu_array)) {
            return 0;
        }
        $menu_array['create_time'] = time();
        $menu = new MenuModel();
        return $menu->save($menu_array);
    }

    public static function updateMenuById(int $id, array $menu_array)
    {
        if(!$id || !is_numeric($id))
        {
            exception('ID不合法');
        }
        if(!$menu_array || !is_array($menu_array))
        {
            exception('数据不合法');
        }
        $menu = new MenuModel();
        return $menu->allowField(true)->save($menu_array, ['menu_id' => $id]);
    }


    public static function getMenusCount(array $map)
    {
        $map['status'] = array('neq', '-1');
        $menu = new MenuModel();
        return $menu->where($map)->count();
    }

    public static function getMenuPaginate(array $map,int $size, int $count)
    {
        $map['status'] = array('neq', '-1');
        $menu = new MenuModel();
        return $menu->where($map)->order('menu_id desc')->paginate($size, $count);
    }

    public static function getMenuById(int $id)
    {
        if (!$id || !is_numeric($id))
        {
            return 0;
        }
        $menu = new MenuModel();
        return $menu->get($id)->find();
    }
}