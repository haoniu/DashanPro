<?php namespace Admin\Controller;
use Hdphp\Controller\Controller;
use Common\Model\Type;

/**
 * 
 * 类型控制器
 * 2015/11/25
 * 
 */
 
class TypeController extends CommonController{
	private $model;
	public function __init(){
		parent::__init();
		$this->model = new Type;
	}
	
	public function index(){
		//获得类型的数据
		$tData = $this->model->get();
		//分配类型显示
		View::with('tData',$tData);
		View::make();
	}
	
	public function add(){
		if(IS_AJAX){
			//调用模型的保存操作
			if(!$this->model->store()){
				echo json_encode(array('status'=>false,'message'=>$this->model->getError()));
			}else{
				echo json_encode(array('status'=>true,'message'=>'添加成功'));
			}
			exit;
		}
		View::make();
	}
	
	public function edit(){
		$tid = Q('get.tid',0,'intval');
		//执行修改
		if(IS_POST){
			if(!$this->model->edit($tid))	View::error($this->model->getError());
			View::success('修改成功',U('Type/index'));
		}
		//先获得旧数据
		$oldData = $this->model->where("tid={$tid}")->find();
		//分配旧数据给页面
		View::with('oldData',$oldData);
		View::make();
	}
	
	public function del(){
		//先获得要删除的id
		$tid = Q('get.tid',0,'intval');
		//执行删除
		if(!$this->model->del($tid))	View::error($this->model->getError());
		
		View::success('删除成功',U('Type/index'));
	}
	
	//类型属性
	public function attr(){
		
		View::make();
	}
}


 ?>