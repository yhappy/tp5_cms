<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/25
 * Time: 下午1:25
 */

namespace app\admin\controller;


use think\Cache;

class Info extends CommonController
{
    public function Index()
    {
        $data = [];
        foreach (['name', 'keyword', 'discription'] as $item) {
            $data[$item] = Cache::get($item,'');
        }
        $this->assign('info', $data);
        return $this->fetch('index/info/edit');
    }

    /**
     *
     */
    public function add()
    {
        if (!$_POST) {
            return redirect(config('__ADMIN__') . '/info');
        }
        foreach (['name', 'keyword', 'discription'] as $item) {
            if (isset($_POST[$item])) {
                if (!$_POST[$item]){
                    show(0, '提示消息：不能为空');
                }
                if (Cache::set($item,$_POST[$item], 0)) {
                    show(1, '提示消息：修改成功');
                } else {
                    show(0, '提示消息：修改失败');
                }
            }
        }
        show(0, '无效输入');
    }
}
