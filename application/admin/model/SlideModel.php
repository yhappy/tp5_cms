<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/23
 * Time: 上午1:16
 */

namespace app\admin\model;


use think\Model;

class SlideModel extends Model
{
    protected $table = 'cms_slide';

    public static function insertNews(array $data)
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        $data['create_time'] = time();
        $news = new NewsModel();
        if ($news->allowField(true)->save($data)) {
            return $news->news_id;
        }
        return 0;
    }
}