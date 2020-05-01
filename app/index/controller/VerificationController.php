<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\index\controller;
use think\Controller;
use think\Db;

class VerificationController extends BaseController
{
    /**
     * 发送验证码
     */
    function send()
    {
        $data = $this->request->param();
        $validate = $this->validate($data,[
            'user_mobile' => 'require|mobile',
        ],[
            'user_mobile:require' => '请输入手机号',
            'user_mobile:mobile' => '手机号格式错误',
        ]);
        if($validate !== true)
            $this->ajaxReturn(['status'=>0,'message'=>$validate]);
        $user = Db::name('user')->where('user_mobile',$data['user_mobile'])->find();
        if(!$user){
            $this->ajaxReturn(['status'=>'0','message'=>'您无权设置密码']);
        }
        $code = cmf_get_verification_code($data['user_mobile']);
        if (!$code['status']) {
            $this->ajaxReturn(['status'=>0,'message'=>$code['message']]);
        }
        $param  = ['mobile' => $data['user_mobile'], 'code' => $code['data']];
        $result = hook_one("send_mobile_verification_code", $param);
        if (!$result['status']) {
            $this->ajaxReturn(['status'=>0,'message'=>$result['message']]);
        }
        $expireTime = empty($result['data']['expire_time']) ? 0 : $result['data']['expire_time'];

        cmf_verification_code_log($data['user_mobile'], $code['data'], $expireTime);
        $this->ajaxReturn(['status'=>1,'message'=>"发送成功！"]);
    }
}
