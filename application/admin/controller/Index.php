<?php

namespace app\admin\controller;

use think\controller;
use app\admin\model\admin;

Class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}


