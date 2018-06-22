<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/13
 * Time: 上午12:16
 */

namespace app\admin\model;
use think\model;


class AdminModel extends model
{
    protected $table = 'cms_admin';
     public function getAdminByUsername(string $username)
    {
        return  $this->where('username', $username)->find();
    }
}