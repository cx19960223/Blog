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
}