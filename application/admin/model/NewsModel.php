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
        $data['username'] = getLoginuser()?getLoginuser():'未知';
        $news = new NewsModel();
        if ($news->allowField(true)->save($data)) {
            return $news->news_id;
        }
        return 0;
    }


    public static function getNewsCount(array $map)
    {
        $map['status'] = array('neq', '-1');
        return self::where($map)->count();
    }

    public static function getNewsPaginate(array $map, int $size, int $count)
    {
        $map['status'] = array('neq', '-1');
        $content = new NewsModel();
        return $content->where($map)->order('listorder desc, news_id desc')->paginate($size, $count);
    }

    public static function updateNewsById(int $id, array $data)
    {
        if (!$id || !is_numeric($id)) {
            exception('ID不合法');
        }
        if (!$data || !is_array($data)) {
            exception('数据不合法');
        }
        $data['update_time'] = time();
        $news = new NewsModel();
        return $news->allowField(true)->save($data, ['news_id' => $id]);
    }

    public static function getNewsById(int $id)
    {
        if (!$id || !is_numeric($id)) {
            return 0;
        }
        return self::where('news_id', $id)->find();
    }

}