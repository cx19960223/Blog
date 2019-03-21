<?php

namespace app\index\controller;

use think\Controller;
use app\common\validate\CommonValidate;//公共验证类
use app\index\model\User as UserModel;//用户模型
use app\index\model\Article as ArticleModel;//文章模型

class Base extends Controller
{
    //验证器
    protected $validate = '';
    // 模型
    protected $model = '';
    // 文件存储路径
    protected $img_src = 'all/img/';

    public function __construct()
    {
        parent::__construct();
        $this->validate = new CommonValidate;
        $this->userModel = new UserModel;
        $this->articleModel = new ArticleModel;
    }
   
    /** 
    * 单图上传
    * @param file 文件
    * @return string 图片路径
    */
    public function uploadImg($file = ''){
        // tp5.1默认存储文件格式为 当前日期为子目录，以微秒时间的md5为文件名
        $info = $file->validate(['size'=>1048576,'ext'=>'jpg,png,gif,jpeg'])->move($this->img_src);
        if($info){
            // 成功上传后 返回图片路径
            return $this->img_src.$info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $file->getError();
        }
   }
}
