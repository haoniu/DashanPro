<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;


/**
 * 
 * 购物车显示控制器
 * 2015/12/06
 * 
 */

class OrderController extends CommonController{
	
	public function index(){
		//先获得购买的sid
		$sid = $_SESSION['sids']['sid'];
		//将字符串拆分成数组
		$sids = explode(",", $sid);
		//建一个空数组存放当前购买的商品
		$cartData = array();
		//获取当前购物车数据
		$Data = Cart::getGoods();
		//获取商品的信息
		foreach ($Data as $k => $v) {
			if(in_array($k, $sids)){
				$cartData[] = $v;
			}
		}
		//获得商品总价格和总的数量
		$cartData['allTotal'] = 0;
		$cartData['allNum'] = 0;
		foreach ($cartData as $key => $value) {
			$cartData['allTotal'] += $value['total'];
			$cartData['allNum'] += $value['num'];
		}
		$_SESSION['allTotal'] = $cartData['allTotal'];
		//p($cartData);
		
		//地址模型
		$addModel = new \Common\Model\OrderAdd;
		$uid = $_SESSION['uid'];
		//获得当前用户所有的地址
		$addData = $addModel->where("uid={$uid}")->get();
		
		
		View::with('addData',$addData);
		View::with('cartData',$cartData);
		View::make();
	}
	
	//添加新的地址
	public function add(){
		$model = new \Common\Model\OrderAdd;
		if(IS_AJAX){
			//调用模型的保存操作
			if(!$model->store()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'添加成功'));
			}
			exit;
		}
	}
	
	
	//提交订单
	public function ajaxSubdata(){
		$model = new \Common\Model\Order;
		if(IS_AJAX){
			$oidData = $model->store();
			if(!$oidData)	View::error($model->getError());
			echo json_encode($oidData);
			exit;
		}
	}
}
?>