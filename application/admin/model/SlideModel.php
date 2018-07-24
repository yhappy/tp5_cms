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

    public static function insertSlide(int $news_id)
    {
        if (!$news_id || !is_numeric($news_id)) {
            return 0;
        }
        $slide = new SlideModel();
        $data['news_id'] = $news_id;
        $data['create_time'] = time();
        return $slide->save($data);
    }

    public static function getSlideByNewsId(int $news_id)
    {
        if (!$news_id || !is_numeric($news_id)) {
            return 0;
        }
        return self::where('news_id', $news_id)->find();
    }

    public static function getSlideCount()
    {
        $map['status'] = array('neq', '-1');
        return self::where($map)->count();
    }

    public static function getSlidePaginate(array $map, int $size, int $count)
    {
        $map['status'] = array('neq', '-1');
        $slide = new SlideModel();
        return $slide->where($map)->order('listorder desc, news_id desc')->paginate($size, $count);
    }

    public static function updateSlideById(int $id, array $data)
    {
        if (!$id || !is_numeric($id)) {
            exception('ID不合法');
        }
        if (!$data || !is_array($data)) {
            exception('数据不合法');
        }
        $news = new SlideModel();
        return $news->allowField(true)->save($data, ['id' => $id]);
    }
}