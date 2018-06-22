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
    public static function insert_Menu(array $menu_array)
    {
        $menu = new MenuModel();
        return $menu->save($menu_array);
    }

}