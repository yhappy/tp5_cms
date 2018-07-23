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
}