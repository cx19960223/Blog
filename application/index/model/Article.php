<?php
namespace app\index\model;
use think\Model;

class Article extends Model{
    /**
     * 保存文章
     * @return string
     */
    public function saveArticle($params = '')
    {
        // 过滤post数组中的非数据表字段数据
        return $this->allowField(true)->save($params);
    }

    /**
     * 获取用户发布的文章
     * @param name 用户名称
     * @return array 
     */
    public function articleList($name = '')
    {
        $result = $this->alias('a')
        ->leftJoin('user u','u.name = a.author')
        ->field('a.id,a.title,a.save_time,a.status,a.tag')
        ->paginate(20);
        return !empty($result) ? $result : '';
    }

}