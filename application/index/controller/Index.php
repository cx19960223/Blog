<?php
namespace app\index\controller;
use think\facade\Session;
use think\Db;

class Index extends Base
{
    public $userModel = '';

    // animated css载入动画
    public $animated = 
    [
        'bounce','flash','pulse','shake','swing','tada','wobble','bounceIn',//0-7
        'bounceInDown','bounceInLeft','bounceInRight','bounceInUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft',//8-15
        'fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY',//16-23
        'lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight',//24-29
        'slideInDown','slideInLeft','slideInRight','rollIn'//30-33
    ];

    public function index()
    {
        //  查询已发布的文章
        $list = $this->articleModel->where('status = 1')->order('publish_time', 'desc')->paginate(4);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 动画显示随机选择赋值，
        $this->assign('animated',$this->animated[rand(0,33)]);
        // 渲染模板输出
        return $this->fetch('/index');
    }

    public function article()
    {
        $article = '';
        if(!empty($_GET['id'])){
            $article =  $this->articleModel->where('id',$_GET['id'])->find();
        }
        $this->assign('article',$article);
        return $this->fetch('/article');
    }

    // 跳转到发布文章
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
                return  ["code" => 404, "msg" => '账号不存在'];
            }
        }else{
            return "<script>alert('请先登录！');window.location.href='index';</script>";
        }
    }

    // 保存文章
    public function saveArticle()
    {
        if(!empty($_FILES['cover']['name'])){
            $file = request()->file('cover');// 获取表单上传封面
            $cover_name = $this->uploadImg($file);//上传图片到本地，上传成功返回图片名称
            $_POST['cover'] = $cover_name;
        }else{
            $_POST['cover'] = '';
        }
        $_POST['save_time'] = time();//保存时间
        $_POST['publish_time'] = time();//当前是直接发布，所以发布时间 = 保存时间
        $_POST['author'] = session('name');//获取发布者的名称
        // 启动事务
        Db::startTrans();
        try {
            $this->articleModel->saveArticle($_POST);
            // 提交事务
            Db::commit();
            return "<script>window.location.href='index';</script>";
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return "<script>alert('事务回滚！');window.location.href='publish';</script>";
        }
    }

}
