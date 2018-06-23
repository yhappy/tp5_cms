<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function show($status, $message, $data = array())
{
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($result));
}

function getMD5WithSalt(string $input)
{
    return md5($input . config('MD5_SALT'));
}

function getStatus($status)
{
    switch ($status)
    {
        case 1: return "开启";
        case 0: return "关闭";
        case -1: return "已删除";
        default: return "不明";
    }
}