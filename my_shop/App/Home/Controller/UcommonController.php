<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;

/**
 * 
 * 用户登录判断公共控制器
 * 2015/12/10
 * 
 */
class UcommonController extends CommonController{
	
	public function __init(){
		parent::__init();
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