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

    public static function getContentByNewsId(int $news_id)
    {
        if (!$news_id || !is_numeric($news_id)) {
            return 0;
        }
        return self::where('news_id', $news_id)->find();
    }

    public static function updateContentByNewsId(int $news_id, $news_content)
    {
        if (!$news_id || !is_numeric($news_id)) {
            return 0;
        }
        $data['update_time'] = time();
        $data['content'] = htmlspecialchars($news_content);
        $content = self::getContentByNewsId($news_id);
        if ($content) {
            if($content['content']==$data['content']){
                return 0;
            }
            return $content->save($data);
        } else {
            $data['news_id'] = $news_id;
            return self::insertContent($data);
        }


    }


}
