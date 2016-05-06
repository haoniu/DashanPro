<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 管理员控制器
 */
class AdminController extends CommonController{
    private $admin;
    /**
     * 初始化
     */
    public function _initialize(){
        parent::_initialize();
        $this->admin = D('Admin');
    }
    /**
     * 修改密码
     */
    public function changePwd(){
        if (IS_POST) {
            $password=I('post.password');
            $newPassword=I('post.newPassword');
            $confirmPassword=I('post.confirmPassword');

            if ($this->admin->changeData($password,$newPassword,$confirmPassword)) {
                session('aname',null);
                session('aid',null);
                $this->success('修改成功');
            }
            $this->error($this->admin->getError());
        }
        $this->display();
    }

}