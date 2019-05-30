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
    // animated css载入动画
    public $animated = 
    [
        'bounce','flash','pulse','shake','swing','tada','wobble','bounceIn',//0-7
        'bounceInDown','bounceInLeft','bounceInRight','bounceInUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft',//8-15
        'fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY',//16-23
        'lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight',//24-29
        'slideInDown','slideInLeft','slideInRight','rollIn'//30-33
    ];
    // 字体颜色
    public $color = 
    [
        'text-primary','text-success','text-info','text-warning','text-danger'
    ];

    // 导航栏信息
    protected $nav = [
        'technology' => ['关于技术','yelp'],
        'share' => ['读书笔记','pagelines'],
        'study' => ['随笔心得','paw'],
        'think' => ['思考总结','github'],
        'life' => ['业余生活','spinner']
    ];
    // 文章作者
    protected $author = [
        'chenxin' => '菜穗子'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->validate = new CommonValidate;
        $this->userModel = new UserModel;
        $this->articleModel = new ArticleModel;
        $this->assign('nav',$this->nav);
        // 动画赋值
        $this->assign('animated',$this->animated);
        // 字体颜色赋值
        $this->assign('color', $this->color);
    }
   
    /** 
    * 单图上传
    * @param file 文件
    * @return string 图片路径
    */
    public function uploadImg($file = ''){
        // tp5.1默认存储文件格式为 当前日期为子目录，以微秒时间的md5为文件名
        $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move($this->img_src);
        if($info){
            // 成功上传后 返回图片路径
            return '/'.$this->img_src.$info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $file->getError();
        }
   }
}
