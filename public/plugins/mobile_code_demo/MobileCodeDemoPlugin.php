<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\mobile_code_demo;//Demo插件英文名，改成你的插件英文就行了
use cmf\lib\Plugin;
use Qcloud\Sms\SmsSingleSender;

/**
 * MobileCodeDemoPlugin
 */
class MobileCodeDemoPlugin extends Plugin
{

    public $info = [
        'name'        => 'MobileCodeDemo',
        'title'       => '腾讯云短信验证码插件',
        'description' => '腾讯云短信验证码插件',
        'status'      => 1,
        'author'      => 'wushunjun',
        'version'     => '1.0'
    ];

    public $has_admin = 0;//插件是否有后台管理界面

    public function install() //安装方法必须实现
    {
        return true;//安装成功返回true，失败false
    }

    public function uninstall() //卸载方法必须实现
    {
        return true;//卸载成功返回true，失败false
    }

    //实现的send_mobile_verification_code钩子方法
    public function sendMobileVerificationCode($param)
    {
        $mobile        = $param['mobile'];//手机号
        $code          = $param['code'];//验证码
        $config        = $this->getConfig();
        $expire_minute = intval($config['expire_minute']);

        try {
            $ssender = new SmsSingleSender($config['app_id'], $config['app_key']);
            $params = [$code,$expire_minute];
            $result = $ssender->sendWithParam("86", $mobile, $config['template_id'],
                $params, $config['sms_sign'], "", "");
            $res = json_decode($result,true);
        } catch(\Exception $e) {
            $res = $e;
        }
        if($res['result'] == 0 && $res['errmsg'] == 'OK'){
            $result = ['status'=>1,'message'=>'成功','data'=>['expire_time'=>time() + $expire_minute * 60]];
        }else{
            $result = ['status'=>0,'message'=>$res['errmsg']];
        }
        return $result;
    }

}