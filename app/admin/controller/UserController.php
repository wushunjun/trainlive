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
     * 编辑
     */
    public function edit()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
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
}