<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/13
 * Time: 上午12:16
 */

namespace app\admin\model;
use think\model;


class admin extends model
{
     public function getAdminByUsername($username)
    {
        return  $this->where('username', $username)->find();
    }
}