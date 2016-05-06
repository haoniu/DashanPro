<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;
use Common\Model\Order;
use Common\Model\OrderList;
use Common\Model\Goods;

/**
 * 
 * 个人中心控制器
 * 2015/12/10
 * 2015/12/28 修复订单显示，订单详情
 * 
 */
class UserController extends CommonController{
	public function __init(){
		parent::__init();
		$this->autoLogin();
	}
	//验证是否登录
	public function autoLogin(){
		//如果没有登录则跳转登录页面
		if(!isset($_SESSION['uname']) || !isset($_SESSION['uid'])){
			//跳转登录控制器
			go(U('Login/index'));
		}
	}
	public function index(){
		
		//获得到当前的用户uid
		$uid = $_SESSION['uid'];
		//获取所有的订单数据
		$orderData = $this->getOrders($uid);
		
		
		//p($orderData);
		
		
		View::make();
	}
	
	public function order(){
		//获得到当前的用户uid
		$uid = $_SESSION['uid'];
		//获取所有的订单数据
		$orderData = $this->getOrders($uid);
		
		//重新组一个新的数组，把商品的详情信息压进去
		foreach($orderData as $k=>$v){
			$orderData[$k]['details'] = $this->getGoods($v['oid']);
		}
		//分配订单给页面
		View::with('orderData',$orderData);
		View::make();
	}
	
	//订单详情
	public function details(){
		$orderModel = new Order;
		if(IS_POST){
			$orderModel->qpay();
			View::success('确认收货！',U('User/order'));
		}
		
		//获取uid
		$oid = Q('get.oid',0,'intval');
		//获取所有的商品内容
		$goodsData = $this->getGoods($oid);
		//获得订单信息
		$orderData = $this->getOrderInfo($oid);

		//分配商品信息
		View::with('goodsData',$goodsData);
		//分配订单信息
		View::with('orderData',$orderData);
		View::make();
	}
	
	//获得当前用户的订单
	private function getOrders($uid){
		//实例化一个订单模型
		$orderModel = new Order;
		//查找到当前的订单数据
		$orderData = $orderModel->where("uid={$uid}")->get();
		//返回数据
		return $orderData;
	}
	
	//获取订单内容
	private function getGoods($oid){
		//实例化一个订单内容模型
		$orderModel = new OrderList;
		//查找到当前的订单详情内容
		$orderData = $orderModel->join('goods','goods.gid','=','order_list.gid')->where("oid={$oid}")->get();
		//返回数据
		return $orderData;
	}
	//获得对应订单的信息
	private function getOrderInfo($oid){
		//实例化一个订单模型
		$orderModel = new Order;
		//查找到当前的订单数据
		$orderData = $orderModel->where("oid={$oid}")->find();
		//返回数据
		return $orderData;
	}
}

?>