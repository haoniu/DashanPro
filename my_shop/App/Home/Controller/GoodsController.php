<?php namespace Home\Controller; 
use Hdphp\Controller\Controller;


/**
 * 
 * 货品显示控制器
 * 2015/12/03
 * 2015/12/30  -----修复通过gid来向上找父级cid
 */

class GoodsController extends CommonController{

    //动作
    public function index(){
    	//获得对应货品的gid
    	$gid = Q('get.gid',0,'intval');
		

    	//获得商品的内容和价格---------------------------------------------------------------------------------
    	$goods = new \Common\Model\Goods;
		$goodsData = $goods->join('detail','detail.gid','=','goods.gid')->where("goods.gid={$gid}")->find();
		if(!$goodsData) go('List/index');
		//将goodsdata里面的值转换为一个数组
		$goodsData['photo'] = explode(',', $goodsData['photo']);
		View::with('gdata',$goodsData);
		
		//同过gid来找到对应的cid
		$cate = new \Common\Model\Category;
		$cids = $cate->get();
		
		function getFatherCid($cids,$cid){
			static $list = array();
			foreach($cids as $k=>$v){
				if($v['cid'] == $cid){
					getFatherCid($cids,$v['pid']);
					$list[$k]['cname'] = $v['cname'];
					$list[$k]['cid'] = $v['cid'];
				}
			}
			return $list;
		}
		$fcids = getFatherCid($cids,$goodsData['cid']);
		
		//sp($fcids);
		View::with("fcids",$fcids);
		
		
		//获得商品的规格----------------------------------------------------------------------------------------
		$goodsAttr = new \Common\Model\GoodsAttr;
		$goodsList = new \Common\Model\GoodsList;
		
		//将combine的字符串拆分成数组-----------------------------------
		$attr = $goodsList->where("gid={$gid}")->get();
		$newAttr = array();
		foreach ($attr as $k => $v) {
			$attr[$k]['combine'] = explode(',', $v['combine']);
		}
		foreach ($attr as $k => $v){
			foreach ($v['combine'] as $key => $value) {
				$newAttr[] = $value;
			}
		}
		View::with('attr',$attr);
		
		
		//找到商品规格对应的规格属性----------------------------------------
		//先判断数据库是否有属性数据
		if($newAttr){
			$oldSpec =  $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gtid IN(".implode(',', $newAttr).") AND class='1' ")->get();
			$spec = array();		
			//组成新的规格数组
			foreach ($oldSpec as $k => $v) {
				$spec[$v['taid']]['taname'] = $v['taname'];
				$spec[$v['taid']]['gtvalue'][] = $v['gtvalue'];
				$spec[$v['taid']]['gtid'][] = $v['gtid'];
			}
		}else{
			$spec = array();
		}
		View::with('spec',$spec);
		
		//获得当前的热销商品
		$hotShop = $goods->orderby('click','desc')->limit(5)->get();
		//热销产品
		View::with('hotShop',$hotShop);
        View::make();
    }


	public function ajaxGetAttr(){
		if(IS_AJAX){
			//接收异步的方法
			$A_data = Q("post.",0,'intval');
			
			//新建模型
			$goodsAttr = new \Common\Model\GoodsAttr;
			$goodsList = new \Common\Model\GoodsList;
			
			//将得到spec压成字符串
			$spec = implode(',',$A_data['spec']);
			//获得商品的规格库存和商品编码-------------------------------------------------------------------------------------
			$goods_spec = $goodsList->where("combine='{$spec}'")->find();
			
			//获得附加价格
			
			echo json_encode($goods_spec);
			exit;
			//p($spec);
		}
	}


	












}