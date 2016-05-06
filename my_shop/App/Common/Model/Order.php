<?php namespace Common\Model;
use Hdphp\Model\Model;

/**
 * 
 * 订单模型
 * 2015/12/08
 * 2015/12/25-----修复提交订单时数据库出现空数据,删除购买商品后的session
 * 
 */
class Order extends Model{
	//指定一个表名
	protected $table = "orders";
	//定义自动验证的规则------------
	protected $validate = array(
		//顺序依次是1.表单的name名，2.规则，3.错误信息 4.验证条件 5.验证时间
		
	);
	
	
	

	public function store(){
		//判断验证
		if(!$this->create())	return FALSE;
		//获得购买商品的信息------------------------------------------------------
		//先获得购买的sid
		$sid = $_SESSION['sids']['sid'];
		//将字符串拆分成数组
		$sids = explode(",", $sid);
		//建一个空数组存放当前购买的商品
		$goodsData = array();
		//获取当前购物车数据
		$Data = Cart::getGoods();
		//获取商品的信息
		foreach ($Data as $k => $v) {
			if(in_array($k, $sids)){
				$goodsData[] = $v;
			}
		}
		//获得商品总价格和总的数量-----------------------------------------------------
		$shopData = array();
		$shopData['allTotal'] = 0;
		$shopData['allNum'] = 0;
		foreach ($goodsData as $key => $value) {
			$shopData['allTotal'] += $value['total'];
			$shopData['allNum'] += $value['num'];
		}
		
		
		
		//接收异步传过来的发票信息和地址-----------------------------------------------
		$orderData = Q('post.');
		//找到对应地址
		$addModel = new \Common\Model\OrderAdd;
		$orderData = $addModel->where("oaid={$orderData['oaid']}")->find();
		
		//获得订单编号，订单状态，时间
		$orderData['number'] = Cart::getOrderId();
		$orderData['sendtime'] = time();
		$orderData['total'] = $shopData['allTotal'];
		$orderData['allnum'] = $shopData['allNum'];
		//返回一个自增的订单oid
		$oid = $this->add($orderData);
		
	
		//添加订单列表----------------------------------------------------------
		$olistModel = new \Common\Model\OrderList;
		//新建一个订单列表的空数组
		$olData = array();
		//循环添加到数据库
		foreach($goodsData as $v){
			$olData['gid'] = $v['id'];
			$olData['name'] = $v['name'];
			$olData['num'] = $v['num'];
			$olData['oid'] = $oid;
			$olData['subtotal'] = $v['total'];
			$olData['glid'] = $v['glid'];
			//添加
			$olistModel->add($olData);
			
		}
		
		//删除对应的商品session
		foreach($sids as $k=>$v){
			Cart::del($v);
		}
		
		return $oid;
	}
	
	
	public function del($oid){
		//先删除订单列表
		$olistModel = new \Common\Model\OrderList;
		$olistModel->where("oid={$oid}")->delete();
		//删除订单
		$this->where("oid={$oid}")->delete();
		return TRUE;
	}
	
	public function edit(){
		$oid = Q('post.oid');
		if(!$this->create()) return FALSE;
		$this->where("oid={$oid}")->save();
		return TRUE;
	}

	public function pay(){
		$oid = Q('get.oid');
		$this->status = 2;
		$this->where("oid={$oid}")->save();
		return TRUE;
	}
	public function qpay(){
		$oid = Q('get.oid');
		$this->status = 4;
		$this->where("oid={$oid}")->save();
		return TRUE;
	}
}
?>