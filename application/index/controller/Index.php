<?php
namespace app\index\controller;
use think\facade\Session;

class Index extends Base
{
    public $userModel = '';

    public function index()
    {
        return $this->fetch('/index');
    }

    public function article()
    {
        return $this->fetch('/article');
    }

    // 发布文章
    public function publish()
    {
        if(!empty( session('name') )){
            return $this->fetch('/publish');
        }else{
            return $this->login();
        }
    }

    //发布文章 => 登录
    public function login()
    {
        if(!empty($_POST)){
            /**数据检测 */
            if (!$this->validate->scene('checkLogin')->check($_POST)) {
                return ["code" => 403, "msg" => $this->validate->getError()];
            }
            $checkExist = $this->userModel->checkExist($_POST['name']);
            if(!empty($checkExist)){
                // 查看密码是否匹配
                $result = $this->userModel->checkPass($_POST['name'], $_POST['password']);
                if(!empty($result)){
                    Session('id',$result['id']);
                    Session('name',$result['name']);
                    return  ["code" => 200, "msg" => '登录成功'];
                }else{
                    return  ["code" => 400, "msg" => '密码错误'];
                }
            }else{
                return  ["code" => 404, "msg" => '账号不存在～'];
            }
        }else{
            return "<script>alert('请先登录！');window.location.href='index';</script>";
        }
    }
}
