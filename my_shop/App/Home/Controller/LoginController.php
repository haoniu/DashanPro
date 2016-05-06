<?php namespace Home\Controller;
use Hdphp\Controller\Controller;

class LoginController extends Controller{
	
	public function index(){
		if(IS_AJAX){
			//先接收传入的用户名和密码
			$uname = Q('post.uname');
			$password = Q('post.password');
			//实例化模型
			$model = new \Common\Model\Cuser;
			//调用模型的保存操作
			if(!$model->vLogin($uname,$password)){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'登录成功'));
			}
			exit;
		}
		View::make();
	}
	
	
	public function out(){
		//释放当前在内存中已经创建的所有$_SESSION变量
		session_unset();
		//删除当前用户对应的session文件以及释放sessionid
		session_destroy();
		//跳转登录页面
		go(U('Index/index'));
	}
	
	public function ajaxCheck(){
		$uname = Q('post.uname');
		$model = new \Common\Model\Cuser;
		$data = $model->where("uname='{$uname}'")->find();
		//如果输入的名字为admin,那么告诉js用户名存在
		if($data){
			echo json_encode(array('status'=>false,'message'=>'用户名已存在'));
		}else{
			echo json_encode(array('status'=>true,'message'=>'可以注册'));
		}
	}
	
}




 ?>