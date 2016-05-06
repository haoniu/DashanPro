<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;


/**
 * 
 * 订单支付控制器
 * 2015/12/09
 * 
 */

class OrderPayController extends CommonController{
	
	public function index(){
		$orderModel = new \Common\Model\Order;
		if(IS_POST){
			$orderModel->pay();
			View::success('支付成功！',U('User/order'));
		}
		
		
		//接到oid
		$oid = Q('get.oid',0,'intval');
		//查找到oid的信息
		$odata = $orderModel->where("oid={$oid}")->find();
		//p($odata);
		View::with('odata',$odata);
		View::make();
	}
	
}
?>