<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;


class UserController extends CommonController{
	
	
	//构造函数--是为了跳转出去
	public function __init()
	{
        //如果没有登陆
		if(!isset($_SESSION['username']) || !isset($_SESSION['uid'])){
            $str = <<<str
<script>
parent.location.href="./index.php?m=Admin&c=Login";
</script>
str;
			echo $str;exit;
        }
	}
	
	/**
	 * 修改密码
	 */
	public function changePwd(){
		if(IS_POST){
			//接收旧密码
			$password = Q('post.password');
			//实例化一个user模型
			$model = new \Common\Model\User;
			//给接收到的密码加密
			$password = $model->encrypt($_SESSION['username'],$password);
			
			//判断旧密码是否正确
			$data = $model->where("username='{$_SESSION['username']}'")->find();
			if($data['password'] != $password){
				View::error('旧密码错误');
			}
			//判断两次密码是否一样
			$newPassword = Q('post.newPassword');
			$confirmPassword = Q('post.confirmPassword');
			
			if($newPassword != $confirmPassword){
				View::error('两次密码不一样！');
			}
			//修改新密码
			$newPassword = $model->encrypt($_SESSION['username'],$newPassword);
			$model->where("uid={$_SESSION['uid']}")->save(array('password'=>$newPassword));
			//修改完成后直接重新登录
			session_unset();
			session_destroy();
			View::success('修改成功!');
			go(U('Index/index'));
		}
		View::make();
	}
	
	
	
}




?>