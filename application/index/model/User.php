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

    /**
     * 检查密码是否匹配，若匹配返回用户信息
     * @param name 名称
     * @param pass 密码
     * @return arr|int
     */
    public function checkPass($name, $pass)
    {
        $result = $this->where("name like '$name'")->find();
        // 这里用的是 password_hash($pass, PASSWORD_DEFAULT);加密
        if(password_verify($pass,$result['password'])){
            return $result;
        }else{
            return 0;
        }
    }
}
