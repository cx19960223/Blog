<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
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
        return $this->fetch('/publish');
    }
}
