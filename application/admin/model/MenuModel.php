<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/22
 * Time: 下午11:28
 */

namespace app\admin\model;

use think\model;


class MenuModel extends model
{
    protected $table = 'cms_menu';

    public static function insertMenu(array $menu_array)
    {
        if (!$menu_array || !is_array($menu_array)) {
            return 0;
        }
        $menu = new MenuModel();
        return $menu->save($menu_array);
    }

    public static function getMenus(array $map, int $page, int $pagesize)
    {
        $map['menu_status'] = array('neq', '-1');
        $menu = new MenuModel();
        return $menu->where($map)->order('menu_id desc')->page($page, $pagesize)->select();
    }
}