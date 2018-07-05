<?php
/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/7/6
 * Time: 上午12:33
 */

namespace app\admin\model;


use think\Model;

class NewsModel extends Model
{
    protected $table = 'cms_news';

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