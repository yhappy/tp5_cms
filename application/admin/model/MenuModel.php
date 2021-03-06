<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/22
 * Time: 下午11:28
 */

namespace app\admin\model;

use think\Model;


class MenuModel extends Model
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
        if (!$id || !is_numeric($id)) {
            exception('ID不合法');
        }
        if (!$menu_array || !is_array($menu_array)) {
            exception('数据不合法');
        }
        $menu = new MenuModel();
        return $menu->allowField(true)->save($menu_array, ['menu_id' => $id]);
    }


    public static function getMenuCount(array $map)
    {
        $map['status'] = array('neq', '-1');
        return self::where($map)->count();
    }

    public static function getMenuPaginate(array $map, int $size, int $count)
    {
        $map['status'] = array('neq', '-1');
        return self::where($map)->order('listorder desc, menu_id desc')->paginate($size, $count);
    }

    public static function getMenuById(int $id)
    {
        if (!$id || !is_numeric($id)) {
            return 0;
        }
        return self::where('menu_id', $id)->find();
    }

    public static function getAdminMenu()
    {
        $map['status'] = array('neq', '-1');
        $map['menu_type'] = 1;
        return self::where($map)->order('listorder desc, menu_id desc')->select();
    }

    public static function getHomeMenu()
    {
        $map['status'] = array('neq', '-1');
        $map['menu_type'] = 0;
        return self::where($map)->order('listorder desc, menu_id desc')->column('menu_name', 'menu_id');
    }

    public static function getHomeMenuId()
    {
        $map['status'] = array('neq', '-1');
        $map['menu_type'] = 0;
        return self::where($map)->order('listorder desc, menu_id desc')->column('menu_id');
    }
}