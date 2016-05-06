<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
/**
 * 
 *-----登录控制器 
 *2015/11/23 
 * 
 */
 
 
class LoginController extends Controller{
	
	public function index(){
		if(IS_POST){
			//先接收传入的用户名和密码
			$username = Q('post.username');
			$password = Q('post.password');
			
			//实例化模型
			$model = new \Common\Model\User;
			//判断验证是否通过
			if($model->vLogin($username,$password)){
				go(U('Index/index'));
			}
			//验证失败 getError方法就可以获得模型里面的验证错误
			$this->error($model->getError());
		}
		View::make();
	}
	
	
	public function out(){
		//释放当前在内存中已经创建的所有$_SESSION变量
		session_unset();
		//删除当前用户对应的session文件以及释放sessionid
		session_destroy();
		//跳转登录页面
		go(U('Login/index'));
	}
	
}




 ?>