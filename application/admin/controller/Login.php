<?php
namespace app\admin\controller;

use think\Controller;


class Login extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function check()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!trim($username))
        {
            return show(0,'输入账号为空');
        }
        if (!trim($password))
        {
            return show(0,'输入密码为空');
        }
        return show(1, '可以校验');
    }
}
