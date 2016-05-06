<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 订单列表模型
 * 2015/12/09
 * 
 */
class OrderList extends Model{
	//指定一个表名
	protected $table = "order_list";
	//定义自动验证的规则------------
	protected $validate = array(
		
	);
}
?>