<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/6
 * Time: 上午12:32
 */

namespace app\admin\model;

use think\Model;


class ContentModel extends Model
{
    protected $table = 'cms_news_content';

    public static function insertContent(array $data)
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        $data['create_time'] = time();
        $data['content'] = htmlspecialchars($data['content']);
        $content = new ContentModel();
        return $content->allowField(true)->save($data);
    }

}
