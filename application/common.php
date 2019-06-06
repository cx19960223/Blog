<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * 清空文件夹
 * @param path 文件目录
 *  */
function deldir($path){
    //如果是目录则继续
    if(is_dir($path)){
        //扫描一个文件夹内的所有文件夹和文件并返回数组
        $p = scandir($path);
        foreach($p as $val){
            //排除目录中的.和..
            if($val !="." && $val !=".."){
                //如果是目录则递归子目录，继续操作
                if(is_dir($path.$val)){
                    //子目录中操作删除文件夹和文件
                    deldir($path.$val.'/');
                    //目录清空后删除空文件夹
                    @rmdir($path.$val.'/');
                }else{
                    //如果是文件直接删除
                    unlink($path.$val);
                }
            }
        }
    }
}

/**
 * 获得访问设备
 * @return int
 */
function user_agent()
{
    $useragent = strtolower($_SERVER["HTTP_USER_AGENT"]);
    $agent = array(
        'wechat' => 'micromessenger',
        'ipad' => 'ipad',
        'iphone' => 'iphone',
        'android' => 'android',
        'windows' => 'windows nt'
    );
    foreach ($agent as $k => $v) {
        if (stripos($useragent, $v) !== false) {
            return $k;
        }
    }
    return 'unknown';
}