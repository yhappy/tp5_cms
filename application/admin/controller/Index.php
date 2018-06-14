<?php

namespace app\admin\controller;

use think\controller;
use app\admin\model\admin;

Class Index extends Controller
{
    public function index()
    {
        $res = config('MD5_SALT');
        dump(md5('1' . $res));
    }
}


