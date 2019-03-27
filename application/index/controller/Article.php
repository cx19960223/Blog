<?php
namespace app\index\controller;
use think\facade\Session;
use think\Db;

class Article extends Base
{
    // 获取当前作者发布的文章
    public function myArticle()
    {
        $icon = [];
        if(!empty(\session('id'))){
            // 查询当前人发布的文章信息
            $list = $this->articleModel->articleList(session('name'));
            foreach($list as $key => &$val){
                $val['tag'] = $this->nav[$val['tag']][0];
                $val['status'] = ($val['status'] == 1) ? '已发布' : '未发布';
            }
            $page = $list->render();
            // 分类值映射
            $this->assign('list',$list);
            $this->assign('page',$page);
            return $this->fetch('/my_article');
        }else{
            return $this->login();
        }
    }

    /**
     * 删除文章
     * @param id 文章id
     *  */
    public function delete()
    {
        $id = $_POST['id'];
        // 清除文章的图片[start]
        $reuslt = $this->articleModel->where("id = $id")->field('cover,content')->find();
        $cover = ltrim($reuslt['cover'] , '/');//去掉左侧的/ => 封面图路径

        //获取富文本编辑器中的所有img路径[start]
        $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
        preg_match_all ($pattern, $reuslt['content'], $ueditor_img);
        $ueditor_img = $ueditor_img[1];//索引为1的数组是需要删除的数组
        //获取富文本编辑器中的所有img路径[end]
        try {
            if(!empty($cover)){
                unlink($cover);
            }
            if(!empty($ueditor_img)){
                foreach($ueditor_img as $val){
                    unlink( ltrim($val, '/') );
                }
            }
        } catch (\Exception $e){
            return ['code' => '500' ,'msg' => $e->getMessage()];
            die;
        }
        // 清除文章的图片[end]

        // 启动事务
        Db::startTrans();
        try {
            $this->articleModel->where("id = $id")->delete();
            // 提交事务
            Db::commit();
            return ['code' => '200','msg' => '删除文章成功'];
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['code' => '500','msg' => '删除文章失败'];
        }
    }

}
