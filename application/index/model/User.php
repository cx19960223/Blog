<?php
namespace app\index\model;
use think\Model;
class User extends Model{
    /**
     * 检查是否存在
     * @param name 姓名
     * @return id
     */
    public function checkExist($name = '')
    {
        $result = $this->where("name like '$name'")->field('id')->find();
        return $result['id'] ?: '';
    }
}
