<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 登录控制器
 */
class LoginController extends Controller{
    // 定义数据表
    private $db;
    /**
     * 初始化
     */
    public function _initialize(){
        $this->db = D('Admin');
    }
    /**
     * 登录页面
     */
    public function index(){
        if (IS_POST) {
            // 获取用户名和密码
            $aname = I('post.aname');
            $password = I('post.password');
            // 验证
            if ($this->db->vLogin($aname,$password)) {
                $this->redirect('Index/index');
            }
            // 如果验证错误
            $this->error($this->db->getError());
        }
        $this->display();
    }
    /**
     * 退出登录
     */
    public function out(){
        session('aname',null);
        session('aid',null);
        $this->success('退出成功');
    }

}