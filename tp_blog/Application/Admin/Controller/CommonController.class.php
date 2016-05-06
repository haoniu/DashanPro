<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 公共控制器 验证是否登录
 */
class CommonController extends Controller{
    /**
     * 初始化
     */
    public function _initialize(){

        $this->authLogin();
    }
    /**
     * 验证是否登录
     */
    public function authLogin(){
        // 如果没有登录
        if (!isset($_SESSION['aname']) || !isset($_SESSION['aid'])) {
            // 跳转到登录页面
            $this->redirect('Login/index');
        }
    }

}