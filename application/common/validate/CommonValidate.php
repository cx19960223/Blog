<?php
namespace app\common\validate;

use think\Validate;

class CommonValidate extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:15',
        'password'  =>'require|max:100',
    ];
    
    protected $message  =   [
        /**用户名 */
        'name.max'  =>  '用户名超过最大长度了',
        'name.require' => '请填写您的昵称',
        /**密码 */
        'password.max'  =>  '密码超过最大长度了',
        'password.require' => '请填写您的密码',
    ];

    protected $scene = [
        'checkLogin'    =>  ['name','password'],
    ];

}