<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 订单地址模型
 * 2015/12/08
 * 
 */
class OrderAdd extends Model{
	//指定一个表名
	protected $table = "order_add";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		
	);
	
	
	public function store(){
		//判断验证
		if(!$this->create())	return FALSE;
		//接收数据
		$arr = Q('post.add');
		$this->data['add'] = implode(',',$arr);
		//将uid压入数组
		$this->data['uid'] = $_SESSION['uid'];
		$this->add();
		return TRUE;
	}
}
?>