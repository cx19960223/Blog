<?php
namespace app\index\controller;
use think\facade\Session;
use think\Db;
use think\facade\Cache;
use think\Paginator;

class Index extends Base
{
    public $userModel = '';

    public $cache = '';

    public function __construct()
    {
        parent::__construct();
        $this->cache = Cache::init();
    }

    public function index()
    {
        $where = 'status = 1';//  查询已发布的文章
        $type = []; //分页类型

        // 区分分类下的不同文章[start]
        if(!empty($_GET['type'])){
            $where .= " and tag ='".$_GET['type']."'";
            $type = ['type' => $_GET['type'] ];//参考命名空间的think\Paginator,主要是用户不同的分类下点击下一页时链接对应到该分类下
        }
        // 区分分类下的不同文章[end]

        // 如果存在分类则按照分类分页
        $list = $this->articleModel->where($where)->order('publish_time', 'desc')->paginate(4,true,['query' => $type]);
        // 获取分页显示
        $page = $list->render();
        // 获取查询的数量
        $list_count = count($list);

        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('list_count', $list_count);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch('/index');
    }

    // 文章详情
    public function article()
    {
        $article = [];
        $time = [];
        if(!empty($_GET['id'])){
            if( !empty( cache('article_'.$_GET['id']) ) && !empty( cache('time_'.$_GET['id']) ) ) {
                $article = cache('article_'.$_GET['id']);
                $time = cache('time_'.$_GET['id']);
            }else{
                $article =  $this->articleModel->where('id',$_GET['id'])->find();
                // 分割时间，年-月-日[start]
                $time['year'] = date("Y",$article['publish_time']);
                $time['month'] = date("M",$article['publish_time']);
                $time['day'] = date("d",$article['publish_time']);
                // 分割时间，年-月-日[end]

                // 分类值映射[start]
                $article['tager'] = $this->nav[$article['tag']][0];
                $article['author'] = $this->author[$article['author']];
                // 分类值映射[end]
                cache('article_'.$_GET['id'], $article, 0);
                cache('time_'.$_GET['id'], $time, 0);
            }
        }
        $this->assign('article',$article);
        $this->assign('time',$time);
        return $this->fetch('/article');
    }

    // 跳转到发布文章
    public function publish()
    {
        if(!empty( session('name') )){
            //和编辑兼容，不能删[start]
            $info = ['id'=>'','title' => '','cover' => '','info' => '','tag' => '','content' => '','status' => ''];
            $this->assign('info',$info);
            //和编辑兼容，不能删[end]
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
        if(!empty($_POST['id'])){//更新
            if(!empty($_FILES['cover']['name'])){
                $file = request()->file('cover');// 获取表单上传封面
                $cover_name = $this->uploadImg($file);//上传图片到本地，上传成功返回图片名称
                $_POST['cover'] = $cover_name;
                // 删除之前的图片
                $result = $this->articleModel->where('id='.$_POST['id'])->field('cover')->find();
                if(!empty($result['cover'])){
                    unlink(ltrim($result['cover'] , '/'));
                }
            }else{
                unset($_POST['cover']);//若没有则不更新以前的图片
            }
            Db::startTrans();
            try {
                $this->articleModel->allowField(true)->save($_POST,['id' => $_POST['id']]);
                // 提交事务
                Db::commit();
                // 删除缓存数据
                cache('article_'.$_POST['id'], NULL);
                return "<script>window.location.href='/index/article/edit?id=".$_POST['id']."';</script>";
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return "<script>alert('事务回滚！');window.location.href='publish';</script>";
            }
        }else{
            //新增
            unset($_POST['id']);//编辑时才会用的id，新增时这个id为空
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
                $id = Db::name('article')->insertGetId($_POST);
                // 提交事务
                Db::commit();
                return "<script>window.location.href='/index/article/edit?id=".$id."';</script>";
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return "<script>alert('事务回滚！');window.location.href='publish';</script>";
            }
        }
    }

}
