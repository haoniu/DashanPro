<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;

class CommonController extends Controller{
	//框架的构造函数
	public function __init(){
		$this->autoLogin();
	}
	//验证是否登录
	public function autoLogin(){
		//如果没有登录则跳转登录页面
		if(!isset($_SESSION['username']) || !isset($_SESSION['uid'])){
			//跳转登录控制器
			go(U('Login/index'));
		}
	}
}



 ?>