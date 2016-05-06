<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\GoodsList;
/**
 * 
 * 货品列表控制器
 * ---2015/12/01
 * 
 */

class GoodsListController extends CommonController{
	private $model;
	public function __init(){
		parent::init();
		$this->model = new GoodsList;
	}
	
	
	public function index(){
		if (IS_AJAX) {
			if (!$this->model->store()) {
				echo json_encode(array('status' => false, 'message' => $this->model->getError()));
			} else {
				echo json_encode(array('status' => true, 'message' => '添加成功'));
			}
			exit;
		}
		
		
		//获得到当前的gid
		$gid = Q('get.gid',0,'intval');
		//新建一个商品属性模型
		$goodsAttr = new \Common\Model\GoodsAttr;
		//获得商品规格的内容-----------------------------------------------------------------------------------------------
		$oldSpec =  $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gid={$gid} AND class='1'")->get();
		//定义一个数组
		$arr = array();		
		foreach ($oldSpec as $k => $v) {
			$arr[$v['taid']][] = $v;
		}
		//p($arr);
		//规格分配到页面
		View::with('Spec',$arr);
		View::with('gid',$gid);
		
		
		//获取货品内容------------------------------------------------------------------------------------------------------
		$data = $this->model->where("gid={$gid}")->get();
		//将得到的combine转换成数组
		foreach ($data as $k => $v) {
			$data[$k]['combine'] = explode(',', $v['combine']);
		}
		//将得到的combine相对应的gtid赋值
		foreach ($data as $key => $value) {
			foreach ($value['combine'] as $k => $v){
				$data[$key]['gtvalue'][] = $goodsAttr->where('gtid',$v)->pluck("gtvalue");
			}
		}
		//p($data);
		View::with('data',$data);
		
		
		
		View::make();
	}
	
	
	public function edit(){
		//获得gid,glid
		$gid = Q('get.gid',0,'intval');
		$glid = Q('get.glid',0,'intval');
		
		if(IS_POST){
			if(!$this->model->edit($glid))	View::error($this->model->getError());
			View::success('修改成功',U('index',array('gid'=>$gid)));
		}
		
		//新建一个商品属性模型
		$goodsAttr = new \Common\Model\GoodsAttr;
		//获得商品规格的内容---------------------------------------------------------------------------------------------------------
		$oldSpec =  $goodsAttr->join('type_attr','type_attr.taid','=','goods_attr.taid')->where("gid={$gid} AND class='1'")->get();		
		//定义一个数组
		$arr = array();		
		foreach ($oldSpec as $k => $v) {
			$arr[$v['taid']][] = $v;
		}
		//p($arr);
		//规格分配到页面
		View::with('Spec',$arr);
		View::with('gid',$gid);
		
		
		//获得旧数据-----------------------------------------------------------------------------------------------------------------
		$data = $this->model->where("glid={$glid}")->find();
		//将得到的combine转换成数组
		$data['combine'] = explode(',', $data['combine']);
		//将得到的combine相对应的gtid赋值
		foreach ($data['combine'] as $k => $v) {
			$data['gtvalue'][] = $goodsAttr->where('gtid',$v)->pluck("gtvalue");
		}
		//p($data);
		View::with('data',$data);
		
		
		
		View::make();
	}
	
	public function del(){
		$glid = Q('get.glid',0,'intval');
		if(!$this->model->del($glid))	View::error($this->model->getError());
		View::success('删除成功!');
	}
}
 
 
 
 
?>