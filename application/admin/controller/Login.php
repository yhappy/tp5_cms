<?php


namespace app\admin\controller;

use app\admin\model\AdminModel;
use think\Controller;

/**
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    /**
     *  index
     */
    public function index()
    {
        if (session('adminUser'))
            $this->redirect(config('__ADMIN__'));
        return $this->fetch('index');
    }

    /**
     *  check
     */
    public function check()
    {
        if (!isset($_POST)) {
            return $this->index();
        }
        if (!isset($_POST['username']) or !isset($_POST['password'])) {
            return $this->index();
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!trim($username)) {
            return show(0, '输入账号为空');
        }
        if (!trim($password)) {
            return show(0, '输入密码为空');
        }
        $admin = new adminModel();
        $getpwd = $admin->getAdminByUsername($username);
        if (!$getpwd)
            return show(0, '用户不存在');
        if ($getpwd->password == getMD5WithSalt($password)) {
            session('adminUser', $getpwd->username);
            return show(1, '密码正确');
        }

        return show(0, '密码错误');

    }

    /**
     *  login
     */
    public function logout()
    {
        cookie('type', null);
        session('adminUser', null);
        $this->redirect(config('__ADMIN__') . '/login');
    }


}

