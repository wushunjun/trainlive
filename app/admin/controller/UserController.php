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

/**
 * Class UserController
 */
class UserController extends AdminBaseController
{

    /**
     * 用户列表
     */
    public function index()
    {
        $where = ["user_id" => ['gt',0]];
        /**搜索条件**/
        $user_mobile = $this->request->param('user_mobile');
        $user_nickname = $this->request->param('user_nickname');

        if ($user_mobile) {
            $where['user_mobile'] = $user_mobile;
        }

        if ($user_nickname) {
            $where['user_nickname'] = ['like', "%$user_nickname%"];;
        }
        $lists = Db::name('user')
            ->where($where)
            ->order("user_id DESC")
            ->paginate(10);
        $lists->appends(['user_mobile' => $user_mobile, 'user_nickname' => $user_nickname]);
        // 获取分页显示
        $page = $lists->render();
        $this->assign("page", $page);
        $this->assign("lists", $lists);
        return $this->fetch();
    }


    /**
     * 添加
     */
    public function add()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,[
                'user_name' => 'require',
                'user_mobile' => 'require|mobile',
            ],[
                'user_name:require' => '姓名不能为空',
                'user_mobile:require' => '手机号不能为空',
                'user_mobile:mobile' => '手机号格式错误',
            ]);
            if($validate !== true)
                $this->error($validate);
            $param['user_add_time'] = time();
            $result = Db::name('user')->insertGetId($param);
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
            if($param['user_password']){
                $param['user_password'] = md5($param['user_password']);
            }else{
                unset($param['user_password']);
            }
            $result = Db::name('user')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $user_id = $this->request->param('user_id', 0, 'intval');
            $info = DB::name('user')->where(["user_id" => $user_id])->find();
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
        $user_id = $this->request->param('user_id', 0, 'intval');
        if (Db::name('user')->delete($user_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
    /**
     * 导入学员
     */
    public function import()
    {
        if($this->request->isPost()){
            $path = $this->request->param('path');
            $path = '.' . $path;
            /*         * 默认用excel2007读取excel，若格式不对，则用之前的版本进行读取 */
            $PHPReader = new \PHPExcel_Reader_Excel2007();
            if (!$PHPReader->canRead($path)) {
                $PHPReader = new \PHPExcel_Reader_Excel5();
                if (!$PHPReader->canRead($path)) {
                    echo 'no Excel';die;
                }
            }

            $phpExcel = $PHPReader->load($path);
            $currentSheet = $phpExcel->getSheet(0);  //读取excel文件中的第一个工作表
            $allRow = $currentSheet->getHighestRow(); //取得一共有多少行
            //从第一行开始读取数据
            $startRow = 2;
            $arr = [];
            for ($j = $startRow; $j <= $allRow; $j++) {
                //从A列读取数据
                // 读取单元格
                $arr[$j-2]['user_name'] = (string)$phpExcel->getActiveSheet()->getCell("A$j")->getValue();
                $arr[$j-2]['user_mobile'] = (string)$phpExcel->getActiveSheet()->getCell("B$j")->getValue();
                $arr[$j-2]['user_add_time'] = time();
            }
            $result = Db::name('user')->insertAll($arr);
            if($result){
                $this->success('导入成功',url('index'));
            }else{
                $this->error('导入失败');
            }
        }else {
            return $this->fetch();
        }
    }
}