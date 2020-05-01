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
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class CourseController extends AdminBaseController
{

    /**
     * course列表
     */
    public function index()
    {
        $keyword = $this->request->param('keyword','');
        $where = ['course_id'=>['gt',0]];
        if($keyword){
            $where['course_name'] = ['like', "%$keyword%"];
        }
        $lists = model('course')
            ->where($where)
            ->order("course_id DESC")
            ->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        $this->assign('keyword',  $keyword);
        $this->assign('lists',  $lists);
        $this->assign("page", $page);
        return $this->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,'Course.add');
            if($validate !== true)
                $this->error($validate);
            $param['course_add_time'] = time();
            $result = model('course')->insertGetId($param);
            if($result){
                $this->success('添加成功',url('index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            return $this->fetch();
        }
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,'Course.edit');
            if($validate !== true)
                $this->error($validate);
            $result = model('course')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $course_id = $this->request->param('course_id', 0, 'intval');
            $info = model('course')->where(["course_id" => $course_id])->find();
            if(!$info){
                $this->error('没有信息');
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 删除
     */
    public function delete()
    {
        $course_id = $this->request->param('course_id', 0, 'intval');
        if (Db::name('course')->delete($course_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }

    public function ajax_change_live(){
        $course_id = $this->request->param('course_id', 0, 'intval');
        $status = $this->request->param('status', 0, 'intval');
        $course = model('course')->find($course_id);
        if(!$course){
            $this->ajaxReturn(['status'=>0,'message'=>'课程不存在']);
        }
        $res = model('course')->update(['course_id'=>$course_id,'course_status'=>$status]);
        if($res){
            if($status == 1)
                model('course')->where(['course_id'=>['neq',$course_id]])->update(['course_status'=>0]);
            $url = $this->getPushUrl('push.iws365.com','live','562d9f6ea5580321dfedac5de0c2a3e3',time() + 3600 * 8);
            $this->ajaxReturn(['status'=>1,'message'=>'成功','data'=>$url]);
        }else{
            $this->ajaxReturn(['status'=>0,'message'=>'操作失败']);
        }
    }
    function getPushUrl($domain, $streamName, $key = null, $time = null){
        if($key && $time){
            $txTime = strtoupper(base_convert($time,10,16));
            $txSecret = md5($key.$streamName.$txTime);
            $ext_str = "?".http_build_query(array(
                    "txSecret"=> $txSecret,
                    "txTime"=> $txTime
                ));
        }
        return ['url'=>"rtmp://".$domain."/live/",'name'=>$streamName . (isset($ext_str) ? $ext_str : "")];
    }

}