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

class IndexController extends BaseController
{
    /**
     * 直播页面
     */
    function index()
    {
        $course = Db::name('course')->where(['course_status'=>1])->find();
        $this->assign('course',$course);
        return $this->fetch();
    }
}
