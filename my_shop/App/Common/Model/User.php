<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 用户模型
 * 2015/11/24
 * 
 */
class User extends Model{
	//指定一个表名
	protected $table = "adminuser";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('username','required','用户名不能为空',3,3),
        array('password','required','密码不能为空',3,3)
	);
	
	//验证登录
	public function vLogin($username,$password){
		//触发自动验证
		if(!$this->create())	return FALSE;
		//判断用户名是否存在-------------
		$udata = $this->where("username='{$username}'")->find();
		if(!$udata){
			//把当前的错误信息放到error属性中，外面的getError就你可以获得到这个错误信息
			$this->error = "用户名不存在";
			return FALSE;
		}
		//判断密码是否正确
		$password = $this->encrypt($username,$password);
		if($password != $udata['password']){
    		$this->error = '密码错误';
    		return FALSE;
    	}
		//存一个session
		$_SESSION['username'] = $username;
		$_SESSION['uid'] = $udata['uid'];
		return TRUE;
	}
	
	//加密的方法
	public function encrypt($username,$password){
		return md5(md5($username) . md5($password) . 'dashan');
	}
}




 ?>