<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class CourseValidate extends Validate
{
    protected $rule = [
        'course_id' => 'integer|require',
        'course_name' => 'require',
        'course_img' => 'require',
        'course_time' => 'require',
    ];
    protected $message = [
        'course_id.require' => '非法操作',
        'course_id.integer' => '非法操作',
        'course_name.require' => '课程名称不能为空',
        'course_img.require' => '请上传图片',
        'course_time.require' => '请选择培训时间',
    ];

    protected $scene = [
        'add'  => ['course_name', 'course_img', 'course_time'],
        'edit' => ['course_id', 'course_name', 'course_img', 'course_time'],
    ];
}