<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 主控制器
 */
class IndexController extends CommonController{
    
    /**
     * 欢迎页面
     */
    public function welcome(){
        
        $this->display();
    }
    /**
     * 主页
     */
    public function index(){
      
        $this->display();
    }
    

}