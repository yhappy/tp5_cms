<?php


// 应用公共文件
function show($status, $message, $data = array())
{
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );
    header('Content-type: text/html; charset=UTF-8');
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

function getActive($controller_name)
{
    $current_controller = strtolower(request()->controller());
    if($controller_name == $current_controller)
    {
        return true;
    }
    return false;
}