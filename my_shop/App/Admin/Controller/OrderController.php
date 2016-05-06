<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Order;
/**
 * 
 * 订单列表控制器
 * 2015/12/10
 * 
 */

class OrderController extends CommonController{
	private $model;
	public function __init(){
		parent::init();
		$this->model = new Order;
	}
	
	public function index(){
		//获得到所有的订单
		$orderData = $this->model->get();
		//分配页面显示
		View::with('orderData',$orderData);
		View::make();
	}
	
	//查看订单
	public function check(){
		//接收oid
		$oid = Q('get.oid',0,'intval');
		//实例化一个列表模型
		$olistMpdel = new \Common\Model\OrderList;
		//获得相对应的oid的订单信息
		$listData = $olistMpdel->where("oid={$oid}")->get();
		
		//p($listData);
		View::with('listData',$listData);
		View::make();
	}
	
	//显示未付款订单
	public function nopay(){
		//获得到所有未付款的订单
		$orderData = $this->model->where("status=1")->get();
		//分配页面显示
		View::with('orderData',$orderData);
		View::make();
	}
	
	//显示付款订单
	public function pay(){
		//获得到所有付款的订单
		$orderData = $this->model->where("status=2")->get();
		//分配页面显示
		View::with('orderData',$orderData);
		View::make();
	}
	
	//显示发货的订单
	public function send(){
		//获得到所有发货的订单
		$orderData = $this->model->where("status=3")->get();
		//分配页面显示
		View::with('orderData',$orderData);
		View::make();
	}
	
	//删除订单
	public function del(){
		//获得要删除的id
		$oid = Q('get.oid',0,'intval');
		//执行删除方法
		$this->model->del($oid);
		//提示
		View::success('删除成功');
	}
	
	//发货页面
	public function delivery(){
		if(IS_AJAX){
			//调用模型的保存操作
			if(!$this->model->edit()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'信息录入成功~'));
			}
			exit;
		}
		//获取当前的oid
		$oid = Q('get.oid',0,'intval');
		
		//获取旧内容
		$oldData = $this->model->where("oid={$oid}")->find();
		View::with('oid',$oid);
		View::with('oldData',$oldData);
		View::make();
	}
}

?>
	