<?php

/**
 * Created by PhpStorm.
 * User: han
 * Date: 2018/6/18
 * Time: 下午8:31
 */

namespace app\admin\controller;

use app\admin\model\NewsModel;
use app\admin\model\MenuModel;
use app\admin\model\ContentModel;


/**
 * Class News
 * @package app\admin\controller
 */
class News extends CommonController
{

    /**
     *  默认显示list
     */
    public function index()
    {
        return $this->list();
    }

    /**
     *   list
     */
    public function list()
    {
        $map = [];
        $column_type = -1;
        $columns_id = MenuModel::getHomeMenuId();
        $columns_id[] = $column_type;
        $columns = MenuModel::getHomeMenu();
        if (isset($_GET['type']) && in_array($_GET['type'], $columns_id)) {
            $column_type = intval($_GET['type']);
            cookie('column_type', $column_type);
        } elseif (isset($_COOKIE['column_type']) && in_array($_COOKIE['column_type'], $columns_id)) {
            $column_type = intval($_COOKIE['column_type']);
        }
        if ($column_type >= 0) {
            $map['column'] = $column_type;
        }
        $news_count = NewsModel::getNewsCount($map);
        $paginate = NewsModel::getNewsPaginate($map, 4, $news_count);
        $this->assign('columns', $columns);
        $this->assign('list', $paginate);
        $this->assign('type', $column_type);

        return $this->fetch('index/news/list');
    }

    /**
     *  picupload
     */
    public function picUploader()
    {
        $file = request()->file('file');
        if ($file) {
            $info = $file->move('uploads/pic');
            if ($info) {
                // 成功上传后 获取上传信息
                $result = array(
                    // 文件上传成功
                    'result' => 'ok',
                    // 文件在服务器上的唯一标识
                    'id' => 10001,
                    // 文件的下载地址
                    'url' => config('__UPLOADS__') . '/pic/' . $info->getSaveName(),
                );
            } else {
                $result = array(
                    // 文件上传失败
                    'result' => 'failed',
                    // 失败信息
                    'message' => $file->getError(),
                );
            }
            header('Content-type: text/html; charset=UTF-8');
            exit(json_encode($result));
        }
    }

    /**
     *  picupload
     */
    public function kindUploader()
    {
        $file = request()->file('imgFile');
        if ($file) {
            $info = $file->move('uploads/kind');
            if ($info) {
                // 成功上传后 获取上传信息
                $result = array(
                    // 文件上传成功
                    'error' => 0,
                    // 文件的下载地址
                    'url' => config('__UPLOADS__') . '/kind/' . $info->getSaveName(),
                );
            } else {
                $result = array(
                    // 文件上传失败
                    'error' => 0,
                    // 失败信息
                    'message' => '错误' . $file->getError(),
                );
            }
            header('Content-type: text/html; charset=UTF-8');
            exit(json_encode($result));
        }
    }

    /**
     *   add
     */
    public function add()
    {
        if ($_POST) {
            if (!(isset($_POST['title']) && $_POST['title'])) {
                return show('0', '文章标题不能为空');
            }
            if (!(isset($_POST['short_title']) && $_POST['short_title'])) {
                return show('0', '缩略标题不能为空');
            }
            if (!(isset($_POST['column']) && $_POST['column'])) {
                return show('0', '栏目不能为空');
            }
            if (!(isset($_POST['content']) && $_POST['content'])) {
                return show('0', '内容不能为空');
            }
            if (isset($_POST['id'])) {
                return $this->update($_POST);
            }
            //添加操作
            $news_id = NewsModel::insertNews($_POST);
            if ($news_id) {
                $data = array();
                $data['news_id'] = $news_id;
                $data['content'] = $_POST['content'];
                $content_id = ContentModel::insertContent($data);
                if ($content_id) {
                    return show('1', '添加成功');
                } else {
                    return show('1', '属性添加成功，内容添加失败');
                }
            }
            return show('0', '添加失败');
        }
        $homeMenu = MenuModel::getHomeMenu();
        $fontColor = config('FONT_COLOR');
        $copyFrom = config('COPY_FROM');
        $this->assign('homeMenus', $homeMenu);
        $this->assign('fontColors', $fontColor);
        $this->assign('copyFroms', $copyFrom);
        return $this->fetch('index/news/add');
    }


    /**
     *   edit
     */
    public function edit()
    {
        if ($_GET && isset($_GET['id'])) {
            $id = $_GET['id'];
            $one_news = NewsModel::getNewsById($id);
            $this->assign('news', $one_news);

            $homeMenu = MenuModel::getHomeMenu();
            $fontColor = config('FONT_COLOR');
            $copyFrom = config('COPY_FROM');
            $this->assign('homeMenus', $homeMenu);
            $this->assign('fontColors', $fontColor);
            $this->assign('copyFroms', $copyFrom);

            $news_id = $one_news->news_id;
            $content = ContentModel::getContentByNewsId($news_id);
            $this->assign('content', $content);
            return $this->fetch('index/news/edit');
        }
        return $this->redirect('list');
    }

    /**
     *   update
     */
    public function update(array $post)
    {
        //更新操作
        try {
            $updt_news = NewsModel::updateNewsById($post['id'], $post);
            $updt_content = ContentModel::updateContentByNewsId($post['id'], $post['content']);
            if ($updt_news or $updt_content) {
                return show('1', '更新成功');
            }
            return show('0', '没有更改');
        } catch (Exception $e) {
            return show('0', $e->getMessage());
        }
    }

    /**
     *   delete
     */
    public function delete()
    {
        if (!$_POST) {
            return $this->redirect('list');
        } elseif (!isset($_POST['id'])) {
            return show('0', '数据有误');
        }
        //删除操作，实际上是status变-1
        $id = $_POST['id'];
        $del_array = array('status' => '-1');
        try {
            $del_result = NewsModel::updateNewsById($id, $del_array);
            if ($del_result) {
                return show('1', '删除成功');
            }
            return show('0', '删除失败');
        } catch (Exception $e) {
            return show('0', $e->getMessage());
        }
    }

    /*
    update listorder
     */
    public function listorder()
    {
        if (!$_POST) {
            return $this->redirect('list');
        }
        try {
            $id = intval($_POST['id']);
            $listorder = intval($_POST['listorder']);
            $result = NewsModel::updateNewsById($id, ['listorder' => $listorder]);
            if ($result)
                return show(1, "更新排序成功");
            else
                return show(0, "更新没有变化");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }

}