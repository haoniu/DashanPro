<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;


/**
 * 
 * 购物车显示控制器
 * 2015/12/06
 * 
 */

class CartController extends CommonController{
	
	public function index(){
		//获得购物车所有的数据
		$cartData = Cart::getAllData();
		//将数据分配给页面
		View::with('cartData',$cartData);
		//sp($cartData);exit;
		View::make();
	}
	
	//更新购物车
	public function ajaxUpdate(){
		//接收传来的数据
		$data = Q('post.');
		//框架的方法更新购物车
		Cart::update($data);
		return TRUE;
	}
	
	//删除单个数据
	public function cartDel(){
		//接收传来的数据
		$sid = Q('post.sid');
		Cart::del($sid);
	}
	//清空购物车
	public function delAll(){
		Cart::flush(); 
	}
	
	//异步获得购物车商品的属性
	public function ajaxGetCart(){
		if(IS_AJAX){
			//接收异步的数据
			$cartData = Q('post.');
			//实例化各个模型--------------------------------------------------------------------
			$goods = new \Common\Model\Goods;
			$goodsAttr = new \Common\Model\GoodsAttr;
			$goodsList = new \Common\Model\GoodsList;
			
			
			//得到商品名--------------------------------------------------------------------
			$goodsData = $goods->where("gid={$cartData['gid']}")->field('gname,shopprice')->find();
			
			//新建一个数组,组出数据的规格
			$arr = array();
			$glid = 0;
			//先判断异步过来的数据是否有规格属性
			if(!empty($cartData['spec'])){
				//得到商品对应的商品列表的glid
				$glid = $goodsList->where("combine in(". implode(',', $cartData['spec']) .")")->pluck('glid');
				//得到商品规格------------------------------------------------------------------
				foreach ($cartData['spec'] as $k => $v) {
					$goods_attr[] = $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gtid={$v} AND class='1'")->get();	
				}
				//从新组合数组
				foreach ($goods_attr as $key => $value) {
					foreach ($value as $k => $v) {
						$arr[$v['taname']] = $v['gtvalue'];
					}
				}
			}
			
			
			//存入购物车的的内容
			$data = array(
				'id' => $cartData['gid'], // 商品 ID 
			    'name' =>$goodsData['gname'],// 商品名称 
			    'num' => $cartData['num'], // 商品数量 
			    'price' => $goodsData['shopprice'], // 商品价格 
			    'options' => $arr,
			    'glid' => $glid
			);
			//添加到购物车
			Cart::add($data); 
			
			$newCart = array(
				'num' => Cart::getTotalNums(),
				'price' => Cart::getTotalPrice()
			);
			echo json_encode($newCart);
			exit;
			
		}
	}



	//得到要购买的商品的sid
	public function getSid(){
		//接收要得到的sid
		$sid = Q('post.');
		//把得到的sid存入session
		$_SESSION['sids'] = $sid;
	}
	
}





?>