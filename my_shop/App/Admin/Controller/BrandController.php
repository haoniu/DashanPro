<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Brand;
/**
 * 
 * 品牌控制器
 * 2015/11/26
 * 
 */
 
 class BrandController extends CommonController{
 	protected $model;
	public function __init(){
		parent::__init();
		$this->model = new Brand;
	}

	public function index(){
		//获得数据
		$data = $this->model->get();
		//分配数据给页面
		View::with('data',$data);
		View::make();
	}
	
	//添加
	public function add(){
		if(IS_POST){
			if(!$this->model->store())	View::error($this->model->getError());
			View::success('上传成功',U('index'));
		}
		View::make();
	}
	
	
	//修改
	public function edit(){
		//接收要修改的bid
		$bid = Q('get.bid',0,'intval');
		if(IS_POST){
			if(!$this->model->edit($bid))	View::error($this->model->getError());
			View::success('修改成功',U('index'));
		}		
		//获得旧数据
		$oldData = $this->model->where("bid={$bid}")->find();
		//将旧数据分配给页面
		View::with('oldData',$oldData);
		View::make();
	}
	
	
	//删除
	public function del(){
		//接收要删除的bid
		$bid = Q('get.bid',0,'intval');
		//执行删除
		$this->model->del($bid);
		//返回成功提示
		View::success('删除成功');
	}
	
	
 }
 
 
?>