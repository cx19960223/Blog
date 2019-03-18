<?php

namespace app\index\controller;

use think\Controller;
use app\common\validate\CommonValidate;//公共验证类
use app\index\model\User as UserModel;//用户模型

class Base extends Controller
{
    //验证器
    protected $validate = '';
    // 模型
    protected $model = '';

    public function __construct()
    {
        parent::__construct();
        $this->validate = new CommonValidate;
        $this->userModel = new UserModel;
    }
   
}
