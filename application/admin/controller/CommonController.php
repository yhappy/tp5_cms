<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/16
 * Time: 上午12:53
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;


class CommonController extends Controller
{
    public function __construct(request $request = null)
    {
        parent::__construct($request);
        $this->__init();
    }

    private function __init()
    {
        if (!$this->isLogin())
        {
            $this->redirect(config('__ADMIN__').'/login');
        }
    }

    public function getLoginuser()
    {
        return session('adminUser');
    }


    public function isLogin()
    {
        $user = $this->getLoginuser();
        if ($user)
        {
            return true;
        }
        return false;
    }
}