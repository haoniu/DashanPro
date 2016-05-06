<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;
use Common\Model\Goods;

class CommonController extends Controller{
	
	public function __init(){
		$this->allData();
	}
    
	/**
	 * 
	 * 调用头部公共数据分配
	 * 
	 */
	private function allData(){

		$model = new \Common\Model\Category;
		$cateData = $model->get();
		
		$cateData = Data::channelLevel($cateData);
		View::with('cateData',$cateData);
		
		//获得购物车数据
		$cartData = Cart::getAllData();
		$GoodsModel = new Goods;
		$pics = array();
		if($cartData){
			foreach($cartData['goods'] as $k=>$v){
				$cartData['goods'][$k]['pic'] = $GoodsModel->where("gid={$v['id']}")->field('pic')->find();
			}
		}else{
			$cartData['goods'] = array();
			$cartData['total_rows'] = 0;
			$cartData['total'] = 0;
		}
		View::with('cartData',$cartData);

		
	}
	
	
	
	
}