<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 用户注册模型
 * 2015/11/24
 * 
 */
class Regist extends Model{
	//指定一个相对应的表
	protected $table = "user";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		array('uname','required','用户名不能为空',3,3),
        array('password','required','密码不能为空',3,3),
        array('name','required','姓名不能为空',3,3),
        array('sex','required','性别不能为空',3,3),
        array('email','required','邮箱不能为空',3,3),
        array('mobile','required','手机不能为空',3,3),
        array('qq','required','QQ不能为空',3,3),
        array('password','confirm:cpassword','两次密码不能相同',3,3),
        array('qq','password','密码不能为空',3,3),
        array('qq','cpassword','密码不能为空',3,3)
	);
	//自动完成
	protected $auto = array(
		array('sendtime','time','function',3,1)
	);
	//注册方法
	public function reg(){
		//先执行验证
		if(!$this->create()) return false;
		$password = Q('post.password');
		$uname = Q('post.uname');
		//调用user加密方法
		$s = new \Common\Model\User;
		$password = $s->encrypt($uname,$password);
		$this->data['password']=$password;
		//将提交的数据放入数据库中
		$this->add();
		return TRUE;
	}
}


?>