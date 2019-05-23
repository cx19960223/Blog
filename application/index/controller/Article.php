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

    /**
     * 编辑文章
     * @param id 文章id
     */
    public function edit()
    {
        $id = $_GET['id'];
        $info = $this->articleModel->where("id = $id")->find();
        $this->assign('info',$info);
        return $this->fetch("/publish");
    }

    /**
     * 所有文章时间轴
     */
    public function articleList()
    {
        $articles = [];
        $info = [];
        $nav_typeall = 0;
        $where = ' and status = 1';//公共查询条件

        // 获取分类的文章总数量[start]
        foreach($this->nav as $key => $val){
            $nav_type[ $key ] = $this->articleModel->where("tag like '$key'".$where)->count();
            $nav_typeall += $nav_type[ $key ];
        }
        $this->assign('nav_typeall', $nav_typeall);
        $this->assign('nav_type', $nav_type);
        // 获取分类的文章总数量[end]

        // 获取年份的文章数量[start]
        $year_count = $this->articleQuery($where);
        arsort($year_count);
        $this->assign('year_count', $year_count);
         // 获取年份的文章数量[end]

        if( empty($_GET['type']) ){//查看所有文章
            /**
             * 查询所有文章的标题，时间，总数量 且 按照文章的时间进行分类
             * 1.当前的年份 - 最早的年份 = 年份差
             * 2.以年份差为最大值，使变量逐级递加，获取每个年份内的文章
             */
            $articles = $this->articleQuery($where);
            // 获取文章的数量, 导航栏名称 [start]
            $info['article_count'] = $this->articleModel->where('status = 1')->count();
            $info['name'] = '全部文章';
            // 获取文章的数量, 导航栏名称 [end]

        }else{//查询对应分类的文章
            // 判断是查询分类还是查询年份 [分类=> class , 年份 => year]
            if($_GET['type'] == 'class')
            {
                //查询分类，获取具体参数
                $where = " and tag like '".$_GET['tag']."'".$where;
                $articles = $this->articleQuery($where);

                // 获取文章的数量, 导航栏名称 [start]
                $info['article_count'] = $this->articleModel->where("tag like '".$_GET['tag']."'".$where)->count();
                $info['name'] = $this->nav[ $_GET['tag'] ][0];
                // 获取文章的数量, 导航栏名称 [end]
            }else if($_GET['type'] == 'year')
            {
                //查询年份，获取具体参数
                $articles = $this->articleQuery($where, $_GET['tag']);

                $y_start = strtotime($_GET['tag']."-01-01 00:00:00");
                $y_end = strtotime($_GET['tag']."-12-31 23:59:59");

                // 获取文章的数量, 导航栏名称 [start]
                $info['article_count'] = $this->articleModel->where('publish_time >= '.$y_start.' and publish_time <= '.$y_end.$where)->count();
                $info['name'] = $_GET['tag'];
                // 获取文章的数量, 导航栏名称 [end]
            }
        }

        
        // 按照 年份 降序排序
        arsort($articles);
        $this->assign('info', $info);
        $this->assign('articles', $articles);
        return $this->fetch("/article_list");
    }

    /**
     * 针对时间轴函数 articleList 可能会重复调用查询条件，所以单独提出来
     * @param where 不同场景下使用不同的where条件
     * @param years 若该值存在则为查询年份
     * @return arr
     */
    public function articleQuery($where = '', $years = '')
    {
        $last_year = $this->articleModel->order('publish_time')->field('publish_time')->find();
        $last_year = date("Y", $last_year['publish_time']);
        $year = date("Y") - $last_year;

        // 查询特定的时间[start]
        if(!empty($years)){
            $last_year = $years;
            $year = 0;
        }
        // 查询特定的时间 [end]

        for( $i=0;$i<=$year;$i++ ){
            // 以年份为时间节点查询文章[start]
            $y = $i + $last_year;
            $y_start = strtotime($y."-01-01 00:00:00");
            $y_end = strtotime($y."-12-31 23:59:59");
            $year_article = $this->articleModel->where('publish_time >= '.$y_start.' and publish_time <= '.$y_end.$where)
            ->order('publish_time desc')
            ->field('id,title,publish_time')
            ->select();
            // 以年份为时间节点查询文章[end]
            $articles[$y]['year'] = $y;//年份
            $articles[$y]['articles'] = $year_article;//年份下的文章
            $articles[$y]['count'] = count($year_article);//该年份下已发布的文章
        }
        return $articles;
    }

}
