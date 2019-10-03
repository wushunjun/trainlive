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
namespace app\common\model;

use think\Db;
use think\Model;

class CourseModel extends Model
{
    public function setCourseTimeAttr($value)
    {
        return strtotime($value);
    }

    public function getCourseTimeAttr($value)
    {
        return date("Y-m-d H:i",$value);
    }
}
